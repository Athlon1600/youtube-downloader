<?php

namespace YouTube\Models;

use YouTube\Utils\Utils;

/**
 * Class InitialPlayerResponse
 * JSON data that appears inside /watch?v= page [ytInitialPlayerResponse=]
 * @package YouTube\Models
 */
class InitialPlayerResponse extends JsonObject
{
    //public array $videoDetails;
    //public array $microformat;

    public function isPlayabilityStatusOkay(): bool
    {
        return $this->deepGet('playabilityStatus.status') == 'OK';
    }

    public function getVideoDetails(): ?array
    {
        return $this->deepGet('videoDetails');
    }

    public function getCaptionTracks(): array
    {
        return (array)$this->deepGet("captions.playerCaptionsTracklistRenderer.captionTracks");
    }
}