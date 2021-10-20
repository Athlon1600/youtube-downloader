<?php

namespace YouTube\Responses;

use YouTube\Models\InitialPlayerResponse;
use YouTube\Models\VideoInfo;
use YouTube\Models\YouTubeConfigData;
use YouTube\Utils\Utils;

class WatchVideoPage extends HttpResponse
{
    public function isTooManyRequests()
    {
        return
            strpos($this->getResponseBody(), 'We have been receiving a large volume of requests') !== false ||
            strpos($this->getResponseBody(), 'systems have detected unusual traffic') !== false ||
            strpos($this->getResponseBody(), '/recaptcha/') !== false;
    }

    public function isVideoNotFound()
    {
        return strpos($this->getResponseBody(), '<title> - YouTube</title>') !== false;
    }

    public function hasPlayableVideo()
    {
        $playerResponse = $this->getPlayerResponse();
        return $this->getResponse()->status == 200 && $playerResponse->isPlayabilityStatusOkay();
    }

    /**
     * Look for a player script URL. E.g:
     * <script src="//s.ytimg.com/yts/jsbin/player-fr_FR-vflHVjlC5/base.js" name="player/base"></script>
     *
     * @return string|null
     */
    public function getPlayerScriptUrl()
    {
        // check what player version that video is using
        if (preg_match('@<script\s*src="([^"]+player[^"]+js)@', $this->getResponseBody(), $matches)) {
            return Utils::relativeToAbsoluteUrl($matches[1], 'https://www.youtube.com');
        }

        return null;
    }

    // returns very similar response to what you get when you query /youtubei/v1/player
    public function getPlayerResponse()
    {
        // $re = '/ytplayer.config\s*=\s*([^\n]+});ytplayer/i';
        // $re = '/player_response":"(.*?)\"}};/';
        $re = '/ytInitialPlayerResponse\s*=\s*({.+?})\s*;/i';

        if (preg_match($re, $this->getResponseBody(), $matches)) {
            $data = json_decode($matches[1], true);
            return new InitialPlayerResponse($data);
        }

        return null;
    }

    public function getYouTubeConfigData()
    {
        if (preg_match('/ytcfg.set\(({.*?})\)/', $this->getResponseBody(), $matches)) {
            $data = json_decode($matches[1], true);
            return new YouTubeConfigData($data);
        }

        return null;
    }

    protected function getInitialData()
    {
        // TODO: this does not appear for mobile
        if (preg_match('/ytInitialData\s*=\s*({.+?})\s*;/i', $this->getResponseBody(), $matches)) {
            $json = $matches[1];
            return json_decode($json, true);
        }

        return null;
    }

    /**
     * @return VideoInfo
     */
    public function getVideoInfo()
    {
        $playerResponse = $this->getPlayerResponse();

        if ($playerResponse) {
            $playerResponse = $playerResponse->all();
        }

        $thumbnails = Utils::arrayGet($playerResponse, 'videoDetails.thumbnail.thumbnails', []);

        $thumbnail_url = null;
        $thumb_max_width = 0;

        foreach ($thumbnails as $thumbnail) {

            if ($thumbnail['width'] > $thumb_max_width) {
                $thumbnail_url = $thumbnail['url'];
                $thumb_max_width = $thumbnail['width'];
            }
        }

        $data = array(
            'id' => Utils::arrayGet($playerResponse, 'videoDetails.videoId'),
            'channelId' => Utils::arrayGet($playerResponse, 'videoDetails.channelId'),
            'channelTitle' => Utils::arrayGet($playerResponse, 'videoDetails.author'),
            'title' => Utils::arrayGet($playerResponse, 'videoDetails.title'),
            'description' => Utils::arrayGet($playerResponse, 'videoDetails.shortDescription'),
            'pageUrl' => $this->getResponse()->info->url,
            'uploadDate' => Utils::arrayGet($playerResponse, 'microformat.playerMicroformatRenderer.uploadDate'),
            'viewCount' => Utils::arrayGet($playerResponse, 'videoDetails.viewCount'),
            'thumbnail' => $thumbnail_url,
            'duration' => Utils::arrayGet($playerResponse, 'videoDetails.lengthSeconds'),
            'keywords' => Utils::arrayGet($playerResponse, 'videoDetails.keywords', []),
            'regionsAllowed' => Utils::arrayGet($playerResponse, 'microformat.playerMicroformatRenderer.availableCountries', [])
        );

        return new VideoInfo($data);
    }
}