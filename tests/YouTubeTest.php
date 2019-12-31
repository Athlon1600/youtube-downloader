<?php

namespace YouTube\Tests;

use PHPUnit\Framework\TestCase;
use YouTube\YouTubeDownloader;

class YouTubeTest extends TestCase
{
    public function test_init()
    {
        $a = new YouTubeDownloader();

        $this->assertTrue(true);
    }
}

