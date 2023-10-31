<?php

namespace YouTube;

use YouTube\Exception\TooManyRequestsException;
use YouTube\Exception\VideoNotFoundException;
use YouTube\Exception\YouTubeException;
use YouTube\Models\VideoInfo;
use YouTube\Models\YouTubeConfigData;
use YouTube\Responses\PlayerApiResponse;
use YouTube\Responses\VideoPlayerJs;
use YouTube\Responses\WatchVideoPage;
use YouTube\Utils\Utils;

class YouTubeDownloader
{
    protected Browser $client;

    function __construct()
    {
        $this->client = new Browser();
    }

    public function getBrowser(): Browser
    {
        return $this->client;
    }

    /**
     * @param string $query
     * @return array
     */
    public function getSearchSuggestions(string $query): array
    {
        $query = rawurlencode($query);

        $response = $this->client->get('http://suggestqueries.google.com/complete/search', [
            'client' => 'firefox',
            'ds' => 'yt',
            'q' => $query
        ]);
        $json = json_decode($response->body, true);

        if (is_array($json) && count($json) >= 2) {
            return $json[1];
        }

        return [];
    }

    public function getVideoInfo(string $videoId): ?VideoInfo
    {
        $page = $this->getPage($videoId);
        // TODO
        return null;
    }

    public function getPage(string $url): WatchVideoPage
    {
        $video_id = Utils::extractVideoId($url);

        // exact params as used by youtube-dl... must be there for a reason
        $response = $this->client->get("https://www.youtube.com/watch?" . http_build_query([
                'v' => $video_id,
                'gl' => 'US',
                'hl' => 'en',
                'has_verified' => 1,
                'bpctr' => 9999999999
            ]));

        return new WatchVideoPage($response);
    }

    protected function getPlayerApiResponse(string $video_id, YouTubeConfigData $configData): PlayerApiResponse
    {
        // exact params matter, because otherwise "slow" download links will be returned
        $response = $this->client->post("https://www.youtube.com/youtubei/v1/player?key=" . $configData->getApiKey(), json_encode([
            "context" => [
                "client" => [
                    "clientName" => "WEB",
                    "clientVersion" => "2.20210721.00.00",
                    "hl" => "en"
                ]
            ],
            "videoId" => $video_id,
            "playbackContext" => [
                "contentPlaybackContext" => [
                    "html5Preference" => "HTML5_PREF_WANTS"
                ]
            ],
            "contentCheckOk" => true,
            "racyCheckOk" => true
        ]), [
            'Content-Type' => 'application/json',
            'X-Goog-Visitor-Id' => $configData->getGoogleVisitorId(),
            'X-Youtube-Client-Name' => $configData->getClientName(),
            'X-Youtube-Client-Version' => $configData->getClientVersion()
        ]);

        return new PlayerApiResponse($response);
    }

    /**
     *
     * @param string $video_id
     * @param array $extra
     * @return DownloadOptions
     * @throws TooManyRequestsException
     * @throws VideoNotFoundException
     * @throws YouTubeException
     */
    public function getDownloadLinks(string $video_id, array $extra = []): DownloadOptions
    {
        $video_id = Utils::extractVideoId($video_id);

        if (!$video_id) {
            throw new \InvalidArgumentException("Invalid Video ID: " . $video_id);
        }

        $page = $this->getPage($video_id);

        if ($page->isTooManyRequests()) {
            throw new TooManyRequestsException($page);
        } elseif (!$page->isStatusOkay()) {
            throw new YouTubeException('Page failed to load. HTTP error: ' . $page->getResponse()->error);
        } elseif ($page->isVideoNotFound()) {
            throw new VideoNotFoundException();
        }

        // a giant JSON object holding useful data
        $youtube_config_data = $page->getYouTubeConfigData();

        // the most reliable way of fetching all download links no matter what
        // query: /youtubei/v1/player for some additional data
        $player_response = $this->getPlayerApiResponse($video_id, $youtube_config_data);

        // get player.js location that holds signature function
        $player_url = $page->getPlayerScriptUrl();
        $response = $this->getBrowser()->cachedGet($player_url);
        $player = new VideoPlayerJs($response);

        $links = SignatureLinkParser::parseLinks($player_response, $player);

        // since we already have that information anyways...
        $info = PlayerVideoInfoMapper::map($player_response);

        return new DownloadOptions($links, $info);
    }
}
