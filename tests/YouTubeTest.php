<?php

namespace YouTube\Tests;

use PHPUnit\Framework\TestCase;
use YouTube\Browser;
use YouTube\YouTubeDownloader;

class YouTubeTest extends TestCase
{
    // We assume that this video will never get taken down
    const BUNNY = 'https://www.youtube.com/watch?v=aqz-KE-bpKQ';

    public function test_browser_cookies()
    {
        $browser = new Browser();

        // set cookies
        $browser->get('https://httpbin.org/cookies/set?name=random_value');

        // list cookies
        $list = $browser->get('https://httpbin.org/cookies');

        $this->assertContains('random_value', $list->body);
    }

    public function test_get_download_links()
    {
        $downloader = new YouTubeDownloader();

        $ret = $downloader->getDownloadLinks(self::BUNNY);

        $this->assertGreaterThan(0, count($ret->getAllFormats()));
    }
}
