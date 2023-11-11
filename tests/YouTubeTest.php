<?php

namespace YouTube\Tests;

use YouTube\Browser;
use YouTube\Exception\YouTubeException;
use YouTube\YouTubeDownloader;

class YouTubeTest extends TestCase
{
    public function test_browser_cookies(): void
    {
        $browser = new Browser();

        // set cookies
        $browser->get('https://httpbin.org/cookies/set?name=random_value');

        // list cookies
        $list = $browser->get('https://httpbin.org/cookies');

        $this->assertStringContainsString('random_value', $list->body);
    }

    public function test_get_download_links(): void
    {
        $downloader = new YouTubeDownloader();

        $ret = $downloader->getDownloadLinks(self::BUNNY_VIDEO_ID);

        $this->assertGreaterThan(0, count($ret->getAllFormats()));
    }

    public function test_get_download_links_bad_video(): void
    {
        $downloader = new YouTubeDownloader();

        try {
            $downloader->getDownloadLinks(self::NOT_FOUND_VIDEO);
            $this->fail();
        } catch (YouTubeException $exception) {
            $this->assertTrue(true);
        }
    }
}
