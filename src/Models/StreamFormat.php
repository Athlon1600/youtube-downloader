<?php

namespace YouTube\Models;

class StreamFormat extends AbstractModel
{
    public ?int $itag = null;
    public ?string $mimeType = null;
    public ?int $width = null;
    public ?int $height = null;
    public ?string $contentLength = null;
    public ?string $quality = null;
    public ?string $qualityLabel = null;
    public ?string $audioQuality = null;
    public ?string $audioSampleRate = null;
    public ?string $url = null;
    public ?string $signatureCipher = null;

    public function getCleanMimeType(): ?string
    {
        return trim(preg_replace('/;.*/', '', $this->mimeType));
    }

    public function hasRateBypass(): bool
    {
        return strpos($this->url, 'ratebypass') !== false;
    }
}