<?php

namespace YouTube\Utils;

class Utils
{
    /**
     * Extract youtube video_id from any piece of text
     * @param $str
     * @return string
     */
    public static function extractVideoId($str)
    {
        if (preg_match('/[a-z0-9_-]{11}/i', $str, $matches)) {
            return $matches[0];
        }

        return false;
    }

    public static function arrayGet($array, $key, $default = null)
    {
        foreach (explode('.', $key) as $segment) {

            if (is_array($array) && array_key_exists($segment, $array)) {
                $array = $array[$segment];
            } else {
                $array = $default;
                break;
            }
        }

        return $array;
    }

    public static function arrayFilterReset($array, $callback)
    {
        return array_values(array_filter($array, $callback));
    }

    /**
     * @param $string
     * @return mixed
     */
    public static function parseQueryString($string)
    {
        $result = null;
        parse_str($string, $result);
        return $result;
    }

    public static function relativeToAbsoluteUrl($url, $domain)
    {
        $scheme = parse_url($url, PHP_URL_SCHEME);
        $scheme = $scheme ? $scheme : 'http';

        // relative protocol?
        if (strpos($url, '//') === 0) {
            return $scheme . '://' . substr($url, 2);
        } elseif (strpos($url, '/') === 0) {
            // relative path?
            return $domain . $url;
        }

        return $url;
    }
}