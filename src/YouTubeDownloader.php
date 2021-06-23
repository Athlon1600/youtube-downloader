<?php

namespace YouTube;

use YouTube\Models\StreamFormat;
use YouTube\Exception\TooManyRequestsException;
use YouTube\Exception\VideoPlayerNotFoundException;
use YouTube\Exception\YouTubeException;
use YouTube\Models\VideoDetails;
use YouTube\Responses\GetVideoInfo;
use YouTube\Responses\VideoPlayerJs;
use YouTube\Responses\WatchVideoPage;
use YouTube\Utils\Utils;

class YouTubeDownloader
{
    protected $client;

    function __construct()
    {
        $this->client = new Browser();
    }

    public function getBrowser()
    {
        return $this->client;
    }

    /**
     * @param $query
     * @return array
     */
    public function getSearchSuggestions($query)
    {
        $query = rawurlencode($query);

        $response = $this->client->get('http://suggestqueries.google.com/complete/search?client=firefox&ds=yt&q=' . $query);
        $json = json_decode($response->body, true);

        if (is_array($json) && count($json) >= 2) {
            return $json[1];
        }

        return [];
    }

    public function getVideoInfo($video_id)
    {
        $video_id = Utils::extractVideoId($video_id);

        $response = $this->client->get("https://www.youtube.com/get_video_info?" . http_build_query([
                'html5' => 1,
                'video_id' => $video_id,
                'eurl' => 'https://youtube.googleapis.com/v/' . $video_id,
                'el' => 'embedded', // or detailpage. default: embedded, will fail if video is not embeddable
                'c' => 'TVHTML5',
                'cver' => '6.20180913'
            ]));

        return new GetVideoInfo($response);
    }

    public function getPage($url)
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

    /**
     * To parse the links for the video we need two things:
     * contents of `player_response` JSON object that appears on video pages
     * contents of player.js script file that's included inside video pages
     *
     * @param array $player_response
     * @param VideoPlayerJs $player
     * @return array
     */
    public function parseLinksFromPlayerResponse($player_response, VideoPlayerJs $player)
    {
        $js_code = $player->getResponseBody();

        $formats = Utils::arrayGet($player_response, 'streamingData.formats', []);

        // video only or audio only streams
        $adaptiveFormats = Utils::arrayGet($player_response, 'streamingData.adaptiveFormats', []);

        $formats_combined = array_merge($formats, $adaptiveFormats);

        // final response
        $return = array();

        foreach ($formats_combined as $format) {

            // appear as either "cipher" or "signatureCipher"
            $cipher = Utils::arrayGet($format, 'cipher', Utils::arrayGet($format, 'signatureCipher', ''));

            // some videos do not need to be decrypted!
            if (isset($format['url'])) {
                $return[] = new StreamFormat($format);
                continue;
            }

            $cipherArray = Utils::parseQueryString($cipher);

            $url = Utils::arrayGet($cipherArray, 'url');
            $sp = Utils::arrayGet($cipherArray, 'sp'); // used to be 'sig'
            $signature = Utils::arrayGet($cipherArray, 's');

            $decoded_signature = (new SignatureDecoder())->decode($signature, $js_code);

            $decoded_url = $url . '&' . $sp . '=' . $decoded_signature;

            $streamUrl = new StreamFormat($format);
            $streamUrl->url = $decoded_url;

            $return[] = $streamUrl;
        }

        return $return;
    }

    /**
     * @param $video_id
     * @param array $options
     * @return DownloadOptions
     * @throws TooManyRequestsException
     * @throws YouTubeException
     */
    public function getDownloadLinks($video_id, $options = array())
    {
        $page = $this->getPage($video_id);

        if ($page->isTooManyRequests()) {
            throw new TooManyRequestsException($page);
        } else if (!$page->isStatusOkay()) {
            throw new YouTubeException('Video not found');
        }

        // get JSON encoded parameters that appear on video pages
        $player_response = $page->getPlayerResponse();

        // it may ask you to "Sign in to confirm your age"
        // we can bypass that by querying /get_video_info
        if (!$page->hasPlayableVideo()) {
            $player_response = $this->getVideoInfo($video_id)->getPlayerResponse();
        }

        if (empty($player_response)) {
            throw new VideoPlayerNotFoundException();
        }

        // get player.js location that holds signature function
        $player_url = $page->getPlayerScriptUrl();
        $response = $this->getBrowser()->cachedGet($player_url);
        $player = new VideoPlayerJs($response);

        $links = $this->parseLinksFromPlayerResponse($player_response, $player);

        // since we already have that information anyways...
        $info = VideoDetails::fromPlayerResponseArray($player_response);

        return new DownloadOptions($links, $info);
    }
}
