<?php

namespace YouTube\Models;

// TODO: CaptionResource extends YouTubeResource
class YouTubeCaption
{
    public ?string $name = null;
    public ?string $languageCode = null;

    // See: https://developers.google.com/youtube/v3/docs/captions#snippet.trackKind
    public ?bool $isAutomatic = null;

    public ?string $baseUrl = null;
}