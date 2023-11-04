<?php

namespace YouTube;

use YouTube\Models\InitialPlayerResponse;
use YouTube\Models\VideoInfo;
use YouTube\Utils\Utils;

class VideoInfoMapper
{
    public static function fromInitialPlayerResponse(InitialPlayerResponse $initialPlayerResponse): VideoInfo
    {
        // "videoDetails" appears in a bunch of other places too
        $videoDetails = $initialPlayerResponse->getVideoDetails();

        $result = new VideoInfo();

        $result->id = Utils::arrayGet($videoDetails, 'videoId');
        $result->title = Utils::arrayGet($videoDetails, 'title');
        $result->description = Utils::arrayGet($videoDetails, 'shortDescription');

        $result->channelId = Utils::arrayGet($videoDetails, 'channelId');
        $result->channelTitle = Utils::arrayGet($videoDetails, 'author');

        $microformat = Utils::arrayGet($initialPlayerResponse->toArray(), 'microformat');

        $date = Utils::arrayGet($microformat, 'playerMicroformatRenderer.uploadDate');

        $result->uploadDate = new \DateTime($date);

        $result->category = Utils::arrayGet($microformat, 'playerMicroformatRenderer.category');

        $result->durationSeconds = Utils::arrayGet($videoDetails, 'lengthSeconds');
        $result->viewCount = Utils::arrayGet($videoDetails, 'viewCount');

        $result->keywords = Utils::arrayGet($videoDetails, 'keywords', []);
        $result->regionsAllowed = Utils::arrayGet($microformat, 'playerMicroformatRenderer.availableCountries', []);

        return $result;
    }
}