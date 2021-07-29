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
        if (strlen($str) === 11) {
            return $str;
        }

        if (preg_match('/(?:\/|%3D|v=|vi=)([a-z0-9_-]{11})(?:[%#?&]|$)/ui', $str, $matches)) {
            return $matches[1];
        }

        return false;
    }

    /**
     * Will parse either channel ID or username from custom URL.
     * Will not parse legacy usernames as those cannot be queried via YouTube API
     * https://support.google.com/youtube/answer/6180214?hl=en
     * @param $url
     * @return mixed|null
     */
    public static function extractChannel($url)
    {
        if (strpos($url, 'UC') === 0 && strlen($url) == 24) {
            return $url;
        }

        if (preg_match('/channel\/(UC[\w-]{22})/', $url, $matches)) {
            return $matches[1];
        }

        if (preg_match('/\/c\/(\w+)/i', $url, $matches)) {
            return $matches[1];
        }

        return null;
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

    public static function getInputValueByName($html, $name)
    {
        if (preg_match("/name=(['\"]){$name}\\1[^>]+value=(['\"])(.*?)\\2/is", $html, $matches)) {
            return $matches[3];
        }

        return null;
    }
}