<?php

namespace YouTube\Models;

class StreamFormat extends AbstractModel
{
    public $itag;
    public $mimeType;
    public $width;
    public $height;
    public $contentLength;
    public $quality;
    public $qualityLabel;
    public $audioQuality;
    public $audioSampleRate;
    public $url;
    public $signatureCipher;

    public function getCleanMimeType()
    {
        return trim(preg_replace('/;.*/', '', $this->mimeType));
    }

    public function hasRateBypass()
    {
        return strpos($this->url, 'ratebypass') !== false;
    }
}