<?php

namespace YouTube\Tests;

use PHPUnit\Framework\TestCase;
use YouTube\Utils\Utils;

class YouTubeUrlTest extends TestCase
{
    const BUNNY_VIDEO_ID = "aqz-KE-bpKQ";

    public function test_id_parsing()
    {
        $file = dirname(dirname(__FILE__)) . '/etc/youtube_urls.txt';
        $contents = file_get_contents($file);

        $lines = explode(PHP_EOL, $contents);

        foreach ($lines as $line) {
            $id = Utils::extractVideoId($line);
            $this->assertEquals(self::BUNNY_VIDEO_ID, $id);
        }
    }
}