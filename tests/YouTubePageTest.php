<?php

namespace YouTube\Tests;

use YouTube\YouTubeDownloader;

class YouTubePageTest extends TestCase
{
    public function test_get_video_info(): void
    {
        $youtube = new YouTubeDownloader();

        $agents = [
            self::UA_FIREFOX,
            self::UA_EDGE,
            self::UA_IPHONE
        ];

        foreach ($agents as $agent) {
            $youtube->getBrowser()->setUserAgent($agent);

            $page = $youtube->getPage(self::BUNNY_VIDEO_ID);

            $info = $page->getVideoInfo();

            // we should be able to parse at least these
            $this->assertNotEmpty($info->id);
            $this->assertNotEmpty($info->title);
            $this->assertNotEmpty($info->channelTitle);
            $this->assertNotEmpty($info->description);
            $this->assertNotEmpty($info->uploadDate);
        }
    }
}