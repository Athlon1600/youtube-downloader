<?php

namespace YouTube;

use YouTube\Models\StreamFormat;
use YouTube\Models\VideoInfo;
use YouTube\Utils\Utils;

// TODO: rename DownloaderResponse
class DownloadOptions
{
    /** @var StreamFormat[] $formats */
    private array $formats = [];

    /** @var VideoInfo|null */
    private ?VideoInfo $info;

    public function __construct(array $formats, ?VideoInfo $info = null)
    {
        $this->formats = $formats;
        $this->info = $info;
    }

    /**
     * @return StreamFormat[]
     */
    public function getAllFormats(): array
    {
        return $this->formats;
    }

    /**
     * @return VideoInfo|null
     */
    public function getInfo(): ?VideoInfo
    {
        return $this->info;
    }

    // Will not include Videos with Audio
    public function getVideoFormats(): array
    {
        return Utils::arrayFilterReset($this->getAllFormats(), function ($format) {
            /** @var $format StreamFormat */
            return strpos($format->mimeType, 'video') === 0 && empty($format->audioQuality);
        });
    }

    public function getAudioFormats(): array
    {
        return Utils::arrayFilterReset($this->getAllFormats(), function ($format) {
            /** @var $format StreamFormat */
            return strpos($format->mimeType, 'audio') === 0;
        });
    }

    /**
     * @return StreamFormat[]
     */
    public function getCombinedFormats(): array
    {
        return Utils::arrayFilterReset($this->getAllFormats(), function ($format) {
            /** @var $format StreamFormat */
            return strpos($format->mimeType, 'video') === 0 && !empty($format->audioQuality);
        });
    }

    /**
     * @return StreamFormat|null
     */
    public function getFirstCombinedFormat(): ?StreamFormat
    {
        $combined = $this->getCombinedFormats();
        return count($combined) ? $combined[0] : null;
    }
}