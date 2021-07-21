<?php

namespace YouTube\Tests;

use PHPUnit\Framework\TestCase;
use YouTube\YouTubeDownloader;

class YouTubePageTest extends TestCase
{
    const BUNNY_VIDEO_ID = "aqz-KE-bpKQ";

    public function test_get_video_info()
    {
        $youtube = new YouTubeDownloader();

        $page = $youtube->getPage(self::BUNNY_VIDEO_ID);

        $info = $page->getVideoInfo();

        // we should be able to parse at least these
        $this->assertNotEmpty($info->id);
        $this->assertNotEmpty($info->title);
        $this->assertNotEmpty($info->description);

        $this->assertNotEmpty($info->pageUrl);
        $this->assertNotEmpty($info->uploadDate);
        $this->assertNotEmpty($info->thumbnail);
    }

}