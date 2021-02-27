<?php

namespace YouTube\Models;

use YouTube\Utils\Utils;

class VideoDetails
{
    protected $videoDetails = array();

    private function __construct($videoDetails)
    {
        $this->videoDetails = $videoDetails;
    }

    /**
     * From `videoDetails` array that appears inside JSON on /watch or /get_video_info pages
     * @param $array
     * @return static
     */
    public static function fromPlayerResponseArray($array)
    {
        return new static(Utils::arrayGet($array, 'videoDetails'));
    }

    public function getId()
    {
        return Utils::arrayGet($this->videoDetails, 'videoId');
    }

    public function getTitle()
    {
        return Utils::arrayGet($this->videoDetails, 'title');
    }

    public function getKeywords()
    {
        return Utils::arrayGet($this->videoDetails, 'keywords');
    }

    public function getShortDescription()
    {
        return Utils::arrayGet($this->videoDetails, 'shortDescription');
    }

    public function getViewCount()
    {
        return Utils::arrayGet($this->videoDetails, 'viewCount');
    }
}