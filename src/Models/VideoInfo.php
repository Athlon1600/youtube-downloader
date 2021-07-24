<?php

namespace YouTube\Models;

class VideoInfo extends AbstractModel
{
    // uniquely identifies this video
    public $id;

    public $channelId;
    public $channelTitle;

    public $title;
    public $description;
    public $uploadDate;

    // accessible by public
    public $pageUrl;

    public $viewCount;
    public $commentCount;
    public $likeCount;
    public $dislikeCount;

    // single URL
    public $thumbnail;

    // in seconds
    public $duration;

    // tags?
    public $keywords = [];

    // If empty, allowed everywhere. ISO 3166 format.
    public $regionsAllowed = [];
}