<?php

namespace YouTube\Tests;

use PHPUnit\Framework\TestCase;
use YouTube\DownloadOptions;
use YouTube\Utils\SerializationUtils;

class StreamFormatTest extends TestCase
{
    public function test_mime_type_parsing(): void
    {
        $json = dirname(dirname(__FILE__)) . '/etc/links.json';

        $utils = SerializationUtils::optionsFromFile($json);

        $this->assertTrue($utils instanceof DownloadOptions);

        $this->assertEquals(18, count($utils->getAllFormats()));

        $first = $utils->getAllFormats()[0];
        $this->assertEquals("video/mp4", $first->getCleanMimeType());

        $this->assertTrue(true);
    }
}