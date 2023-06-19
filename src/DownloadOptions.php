<?php

namespace YouTube;

use YouTube\Models\SplitStream;
use YouTube\Models\StreamFormat;
use YouTube\Models\VideoDetails;
use YouTube\Utils\Utils;

// TODO: rename DownloaderResponse
class DownloadOptions
{
    /** @var StreamFormat[] $formats */
    private $formats;

    /** @var VideoDetails|null */
    private $info;

    public function __construct($formats, $info = null)
    {
        $this->formats = $formats;
        $this->info = $info;
    }

    /**
     * @return StreamFormat[]
     */
    public function getAllFormats()
    {
        return $this->formats;
    }

    /**
     * @return VideoDetails|null
     */
    public function getInfo()
    {
        return $this->info;
    }

    // Will not include Videos with Audio
    public function getVideoFormats()
    {
        return Utils::arrayFilterReset($this->getAllFormats(), function ($format) {
            /** @var $format StreamFormat */
            return strpos($format->mimeType, 'video') === 0 && empty($format->audioQuality);
        });
    }

    public function getAudioFormats()
    {
        return Utils::arrayFilterReset($this->getAllFormats(), function ($format) {
            /** @var $format StreamFormat */
            return strpos($format->mimeType, 'audio') === 0;
        });
    }

    public function getCombinedFormats()
    {
        return Utils::arrayFilterReset($this->getAllFormats(), function ($format) {
            /** @var $format StreamFormat */
            return strpos($format->mimeType, 'video') === 0 && !empty($format->audioQuality);
        });
    }

    /**
     * @return StreamFormat|null
     */
    public function getFirstCombinedFormat()
    {
        $combined = $this->getCombinedFormats();
        return count($combined) ? $combined[0] : null;
    }

    protected function getLowToHighVideoFormats()
    {
        $copy = array_values($this->getVideoFormats());

        usort($copy, function ($a, $b) {

            /** @var StreamFormat $a */
            /** @var StreamFormat $b */

            return $a->height - $b->height;
        });

        return $copy;
    }

    protected function getLowToHighAudioFormats()
    {
        $copy = array_values($this->getAudioFormats());

        // just assume higher filesize => higher quality...
        usort($copy, function ($a, $b) {

            /** @var StreamFormat $a */
            /** @var StreamFormat $b */

            return $a->contentLength - $b->contentLength;
        });

        return $copy;
    }

    protected function getLowToHighCombinedFormats()
    {
        $copy = array_values($this->getCombinedFormats());

        usort($copy, function ($a, $b) {

            /** @var StreamFormat $a */
            /** @var StreamFormat $b */

            return $a->height - $b->height;
        });

        return $copy;
    }

    // Combined using: ffmpeg -i video.mp4 -i audio.mp3 output.mp4
    public function getSplitFormats($quality = null)
    {
        // sort formats by quality in desc, and high = first, medium = middle, low = last
        $videos = $this->getLowToHighVideoFormats();
        $audio = $this->getLowToHighAudioFormats();

        if ($quality == 'high' || $quality == 'best') {

            return new SplitStream([
                'video' => $videos[count($videos) - 1],
                'audio' => $audio[count($audio) - 1]
            ]);

        } else if ($quality == 'low' || $quality == 'worst') {

            return new SplitStream([
                'video' => $videos[0],
                'audio' => $audio[0]
            ]);
        }

        // something in between!
        return new SplitStream([
            'video' => $videos[floor(count($videos) / 2)],
            'audio' => $audio[floor(count($audio) / 2)]
        ]);
    }

    // get best combined format by video quality
    public function getBestCombinedFormat() {
        $combined = $this->getLowToHighCombinedFormats();
        return end($combined);
    }

    // get best video format by quality
    public function getBestVideoFormat() {
        $videos = $this->getLowToHighVideoFormats();
        return end($videos);
    }

    // get best audio format by quality
    public function getBestAudioFormat() {
        $audios = $this->getLowToHighAudioFormats();
        return end($audios);
    }

}