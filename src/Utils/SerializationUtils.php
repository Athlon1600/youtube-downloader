<?php

namespace YouTube\Utils;

use YouTube\Models\StreamFormat;
use YouTube\DownloadOptions;

class SerializationUtils
{
    public static function optionsToArray(DownloadOptions $downloadOptions)
    {
        return array_map(function (StreamFormat $link) {
            return $link->toArray();
        }, $downloadOptions->getAllFormats());
    }

    public static function optionsFromArray($array)
    {
        $links = [];

        foreach ($array as $item) {
            $links[] = new StreamFormat($item);
        }

        return new DownloadOptions($links);
    }

    public static function optionsFromFile($path)
    {
        $contents = @file_get_contents($path);

        if ($contents) {
            $json = json_decode($contents, true);

            if ($json) {
                return self::optionsFromArray($json);
            }
        }

        return null;
    }
}