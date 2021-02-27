<?php

namespace YouTube\Responses;

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

    public function hasPlayableVideo()
    {
        $playerResponse = $this->getPlayerResponse();
        $playabilityStatus = Utils::arrayGet($playerResponse, 'playabilityStatus.status');

        return $this->getResponse()->status == 200 && $playabilityStatus == 'OK';
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

    public function getPlayerResponse()
    {
        // $re = '/ytplayer.config\s*=\s*([^\n]+});ytplayer/i';
        // $re = '/player_response":"(.*?)\"}};/';
        $re = '/ytInitialPlayerResponse\s*=\s*({.+?})\s*;/i';

        if (preg_match($re, $this->getResponseBody(), $matches)) {
            $match = $matches[1];
            return json_decode($match, true);
        }

        return array();
    }
}