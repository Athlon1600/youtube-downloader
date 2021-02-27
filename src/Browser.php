<?php

namespace YouTube;

use Curl\BrowserClient;
use YouTube\Utils\Utils;

class Browser extends BrowserClient
{
    public function setUserAgent($agent)
    {
        $this->headers['User-Agent'] = $agent;
    }

    public function getUserAgent()
    {
        return Utils::arrayGet($this->headers, 'User-Agent');
    }

    public function followRedirects($enabled)
    {
        $this->options[CURLOPT_FOLLOWLOCATION] = $enabled ? 1 : 0;
        return $this;
    }

    public function cachedGet($url)
    {
        $cache_path = sprintf('%s/%s', static::getStorageDirectory(), $this->getCacheKey($url));

        if (file_exists($cache_path)) {

            // unserialize could fail on empty file
            $str = file_get_contents($cache_path);
            return unserialize($str);
        }

        $response = $this->get($url);

        // cache only if successful
        if (empty($response->error)) {
            file_put_contents($cache_path, serialize($response));
        }

        return $response;
    }

    protected function getCacheKey($url)
    {
        return md5($url) . '_v3';
    }
}