<?php

namespace YouTube\Utils;

class Utils
{
    /**
     * Extract youtube video_id from any piece of text
     * @param string $str
     * @return string|null
     */
    public static function extractVideoId(string $str): ?string
    {
        if (strlen($str) === 11) {
            return $str;
        }

        if (preg_match('/(?:\/|%3D|v=|vi=)([a-z0-9_-]{11})(?:[%#?&\/]|$)/ui', $str, $matches)) {
            return $matches[1];
        }

        return null;
    }

    /**
     * Will parse either channel ID or username from custom URL.
     * Will not parse legacy usernames as those cannot be queried via YouTube API
     * https://support.google.com/youtube/answer/6180214?hl=en
     * @param string $url
     * @return string|null
     */
    public static function extractChannel(string $url): ?string
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

    /**
     * @param array $array
     * @param string $key
     * @param mixed $default
     * @return mixed|null
     */
    public static function arrayGet(array $array, string $key, $default = null)
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

    public static function arrayFilterReset(array $array, callable $callback): array
    {
        return array_values(array_filter($array, $callback));
    }

    public static function jsonStringOrFail(string $json): array
    {
        return json_decode($json, true, 512, JSON_THROW_ON_ERROR);
    }

    // str_contains not available in early PHP
    public static function stringContains(string $haystack, string $needle): bool
    {
        return strpos($haystack, $needle) !== false;
    }

    /**
     * @param string $string
     * @return array
     */
    public static function parseQueryString(string $string): array
    {
        $result = [];
        parse_str($string, $result);
        return $result;
    }

    public static function relativeToAbsoluteUrl(string $url, string $domain): string
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

    public static function getInputValueByName(string $html, string $name): ?string
    {
        if (preg_match("/name=(['\"]){$name}\\1[^>]+value=(['\"])(.*?)\\2/is", $html, $matches)) {
            return $matches[3];
        }

        return null;
    }

    public static function sendJson(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }
}