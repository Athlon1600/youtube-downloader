<?php

namespace YouTube\Data;

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
}