<?php

namespace YouTube\Models;

/**
 * General class for holding video info. Not all fields required
 */
class VideoInfo
{
    // uniquely identifies this video
    public ?string $id = null;

    public ?string $channelId = null;
    public ?string $channelTitle = null;

    public ?string $title = null;
    public ?string $description = null;
    public ?\DateTime $uploadDate;

    public ?string $category;

    public ?int $viewCount = null;
    public ?int $commentCount = null;
    public ?int $likeCount = null;
    public ?int $dislikeCount = null;

    // in seconds
    public ?int $durationSeconds = null;

    // tags?
    public array $keywords = [];

    // If empty, allowed everywhere. ISO 3166 format.
    public array $regionsAllowed = [];
}