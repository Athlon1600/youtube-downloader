<?php

namespace YouTube\Models;

class VideoInfo extends AbstractModel
{
    // uniquely identifies this video
    public ?string $id;

    public ?string $channelId = null;
    public ?string $channelTitle = null;

    public ?string $title = null;
    public ?string $description = null;
    public ?string $uploadDate;

    // accessible by public
    public ?string $pageUrl;

    public ?int $viewCount;
    public ?int $commentCount;
    public ?int $likeCount;
    public ?int $dislikeCount;

    /**
     * @var VideoThumbnail[]
     */
    public array $thumbnails;

    public ?string $thumbnail;

    // in seconds
    public ?int $durationSeconds;

    // tags?
    public array $keywords = [];

    // If empty, allowed everywhere. ISO 3166 format.
    public array $regionsAllowed = [];
}