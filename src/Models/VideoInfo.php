<?php

namespace YouTube\Models;

/**
 * General class for holding video info. Not all fields required
 */
class VideoInfo
{
    // uniquely identifies this video
    public ?string $id;

    public ?string $channelId = null;
    public ?string $channelTitle = null;

    public ?string $title = null;
    public ?string $description = null;
    public ?\DateTime $uploadDate;

    public ?string $category;

    public ?int $viewCount;
    public ?int $commentCount;
    public ?int $likeCount;
    public ?int $dislikeCount;

    // in seconds
    public ?int $durationSeconds;

    // tags?
    public array $keywords = [];

    // If empty, allowed everywhere. ISO 3166 format.
    public array $regionsAllowed = [];
}