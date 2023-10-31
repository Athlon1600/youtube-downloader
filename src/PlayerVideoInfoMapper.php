<?php

namespace YouTube;

use YouTube\Models\VideoInfo;
use YouTube\Responses\PlayerApiResponse;
use YouTube\Utils\Utils;

class PlayerVideoInfoMapper
{
    public static function map(PlayerApiResponse $playerApiResponse): VideoInfo
    {
        // look for "videoDetails" key holds a lot of useful information
        $videoDetails = Utils::arrayGet($playerApiResponse->getJson(), "videoDetails");

        $result = new VideoInfo([]);

        if ($videoDetails) {
            $result->id = Utils::arrayGet($videoDetails, 'videoId');
            $result->title = Utils::arrayGet($videoDetails, 'title');
            $result->description = Utils::arrayGet($videoDetails, 'shortDescription');

            $result->channelId = Utils::arrayGet($videoDetails, 'channelId');

            $result->durationSeconds = Utils::arrayGet($videoDetails, 'lengthSeconds');

            $result->viewCount = Utils::arrayGet($videoDetails, 'viewCount');
        }

        return $result;
    }
}