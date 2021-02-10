<?php

namespace YouTube\Resources;

use YouTube\Browser;
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
        $player_url = null;

        // check what player version that video is using
        if (preg_match('@<script\s*src="([^"]+player[^"]+js)@', $this->getResponseBody(), $matches)) {
            $player_url = $matches[1];

            // relative protocol?
            if (strpos($player_url, '//') === 0) {
                $player_url = 'http://' . substr($player_url, 2);
            } elseif (strpos($player_url, '/') === 0) {
                // relative path?
                $player_url = 'http://www.youtube.com' . $player_url;
            }
        }

        return $player_url;
    }

    // TODO: this does not belong here
    public function getCachedPlayerContents()
    {
        $url = $this->getPlayerScriptUrl();

        $browser = new Browser();
        $response = $browser->cachedGet($url);

        return new VideoPlayerJs($response);
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

        return null;
    }
}