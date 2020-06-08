<?php

namespace YouTube;

class Browser
{
    protected $storage_dir;
    protected $cookie_file;

    protected $user_agent = 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0';

    protected $proxy;

    public function __construct()
    {
        $filename = 'youtube_downloader_cookies.txt';

        $this->storage_dir = sys_get_temp_dir();
        $this->cookie_file = join(DIRECTORY_SEPARATOR, [sys_get_temp_dir(), $filename]);
    }

    public function setProxy($proxy_server)
    {
        $this->proxy = $proxy_server;
    }

    public function getCookieFile()
    {
        return $this->cookie_file;
    }

    public function get($url)
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_USERAGENT, $this->user_agent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookie_file);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie_file);

        if ($this->proxy) {
            curl_setopt($ch, CURLOPT_PROXY, $this->proxy);
        }

        //curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function getCached($url)
    {
        $cache_path = sprintf('%s/%s', $this->storage_dir, $this->getCacheKey($url));

        if (file_exists($cache_path)) {

            // unserialize could fail on empty file
            $str = file_get_contents($cache_path);
            return unserialize($str);
        }

        $response = $this->get($url);

        // must not fail
        if ($response) {
            file_put_contents($cache_path, serialize($response));
            return $response;
        }

        return null;
    }

    public function head($url)
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        $result = curl_exec($ch);
        curl_close($ch);

        return http_parse_headers($result);
    }

    // useful for checking for: 429 Too Many Requests
    public function getStatus($url)
    {

    }

    protected function getCacheKey($url)
    {
        return md5($url);
    }
}