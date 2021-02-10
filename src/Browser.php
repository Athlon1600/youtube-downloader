<?php

namespace YouTube;

use Curl\BrowserClient;

class Browser extends BrowserClient
{
    protected $storage_dir;

    public function __construct()
    {
        parent::__construct();

        $cookie_file = join(DIRECTORY_SEPARATOR, [sys_get_temp_dir(), "youtube_downloader_cookies.txt"]);
        $this->setCookieFile($cookie_file);

        // use this for cache
        $this->storage_dir = sys_get_temp_dir();
    }

    public function followRedirects($enabled)
    {
        $this->options[CURLOPT_FOLLOWLOCATION] = $enabled ? 1 : 0;
        return $this;
    }

    private function getJson($url)
    {
        $response = $this->get($url);
        $response->body = json_decode($response->body, true);
        return $response;
    }

    public function cachedGet($url)
    {
        $cache_path = sprintf('%s/%s', $this->storage_dir, $this->getCacheKey($url));

        if (file_exists($cache_path)) {

            // unserialize could fail on empty file
            $str = file_get_contents($cache_path);
            return unserialize($str);
        }

        $response = $this->get($url);

        // cache only if successful
        if ($response->body) {
            file_put_contents($cache_path, serialize($response));
            return $response;
        }

        return null;
    }

    protected function getCacheKey($url)
    {
        return md5($url);
    }

    private function postJson($url, $json)
    {
        return $this->request('POST', $url, $json, [
            'Content-Type' => 'application/json'
        ]);
    }
}