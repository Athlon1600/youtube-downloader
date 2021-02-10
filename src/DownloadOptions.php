<?php

namespace YouTube;

use YouTube\Data\StreamFormat;
use YouTube\Utils\Utils;

class DownloadOptions
{
    private $links;

    public function __construct($links)
    {
        $this->links = $links;
    }

    /**
     * @return StreamFormat[]
     */
    public function getAllLinks()
    {
        return $this->links;
    }

    // Video only!!!
    public function getVideoFormats()
    {
        return Utils::arrayFilterReset($this->getAllLinks(), function ($format) {
            /** @var $format StreamFormat */
            return strpos($format->mimeType, 'video') === 0 && empty($format->audioQuality);
        });
    }

    public function getAudioFormats()
    {
        return Utils::arrayFilterReset($this->getAllLinks(), function ($format) {
            /** @var $format StreamFormat */
            return strpos($format->mimeType, 'audio') === 0;
        });
    }

    public function getCombinedFormats()
    {
        return Utils::arrayFilterReset($this->getAllLinks(), function ($format) {
            /** @var $format StreamFormat */
            return strpos($format->mimeType, 'video') === 0 && !empty($format->audioQuality);
        });
    }

    /**
     * @return StreamFormat|null
     */
    public function getBestCombinedFormat()
    {
        $combined = $this->getCombinedFormats();
        return count($combined) ? $combined[0] : null;
    }
}