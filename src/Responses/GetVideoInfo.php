<?php

namespace YouTube\Responses;

use YouTube\Utils\Utils;

class GetVideoInfo extends HttpResponse
{
    public function getJson()
    {
        return Utils::parseQueryString($this->getResponseBody());
    }

    public function isError()
    {
        return Utils::arrayGet($this->getJson(), 'errorcode') !== null;
    }

    /**
     * About same as `player_response` that appears on video pages.
     * @return array
     */
    public function getPlayerResponse()
    {
        $playerResponse = Utils::arrayGet($this->getJson(), 'player_response');
        return json_decode($playerResponse, true);
    }
}