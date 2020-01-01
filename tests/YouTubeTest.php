<?php

namespace YouTube\Tests;

use PHPUnit\Framework\TestCase;
use YouTube\Browser;
use YouTube\YouTubeDownloader;

class YouTubeTest extends TestCase
{
    const SWIFT = 'https://www.youtube.com/watch?v=e-ORhEE9VVg';
    const PEELE = 'https://www.youtube.com/watch?v=OTUIxtoHxNQ';

    public function test_browser_cookies()
    {
        $browser = new Browser();

        // set cookies
        $browser->get('https://httpbin.org/cookies/set?name=random_value');

        // list cookies
        $list = $browser->get('https://httpbin.org/cookies');

        $this->assertContains('random_value', $list);
    }

    public function test_get_download_links()
    {
        $downloader = new YouTubeDownloader();

        $ret = $downloader->getDownloadLinks(self::SWIFT);

        $this->assertTrue(is_array($ret));
        $this->assertGreaterThan(0, count($ret));
    }
}
