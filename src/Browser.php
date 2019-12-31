<?php

namespace YouTube;

class Browser
{
    public function get($url)
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        //curl_setopt($ch, CURLOPT_COOKIEJAR, $tmpfname);
        //curl_setopt($ch, CURLOPT_COOKIEFILE, $tmpfname);

        //curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function getCached($url)
    {
        // TODO
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
}