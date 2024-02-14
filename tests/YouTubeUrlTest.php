<?php

namespace YouTube\Tests;

use PHPUnit\Framework\TestCase;
use YouTube\Utils\Utils;

class YouTubeUrlTest extends TestCase
{
    const BUNNY_VIDEO_ID = "aqz-KE-bpKQ";

    public function test_id_parsing(): void
    {
        $file = dirname(dirname(__FILE__)) . '/etc/youtube_urls.txt';
        $contents = file_get_contents($file);

        $lines = explode(PHP_EOL, $contents);

        foreach ($lines as $line) {
            $id = Utils::extractVideoId($line);
            $this->assertEquals(self::BUNNY_VIDEO_ID, $id);
        }
    }

    public function test_channel_parsing(): void
    {
        $tests = [
            'https://www.youtube.com/channel/UCkRfArvrzheW2E7b6SVT7vQ' => 'UCkRfArvrzheW2E7b6SVT7vQ',
            'https://www.youtube.com/channel/UC295-Dw_tDNtZXFeAPAW6Aw' => 'UC295-Dw_tDNtZXFeAPAW6Aw',
            // 'https://www.youtube.com/user/creatoracademy' => 'creatoracademy',
            'https://www.youtube.com/c/YouTubeCreators' => 'YouTubeCreators',
            'https://www.youtube.com/c/youtubecreators/videos' => 'youtubecreators',
            'https://www.youtube.com/feed/explore' => null,
            '' => null
        ];

        foreach ($tests as $url => $expected) {
            $this->assertEquals($expected, Utils::extractChannel($url));
        }
    }
}