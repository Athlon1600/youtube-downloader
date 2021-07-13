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

    public function consentCookies()
    {
        $response = $this->get('https://www.youtube.com/');
        $current_url = $response->info->url;

        // must be missing that special cookie
        if (strpos($current_url, 'consent.youtube.com') !== false) {

            $field_names = ['gl', 'm', 'pc', 'continue', 'ca', 'x', 'v', 't', 'hl', 'src', 'uxe'];

            $form_data = [];

            foreach ($field_names as $name) {
                $value = Utils::getInputValueByName($response->body, $name);
                $form_data[$name] = htmlspecialchars_decode($value);
            }

            // this will set that cookie that we need to never see that message again
            $this->post('https://consent.youtube.com/s', $form_data);
        }
    }
}