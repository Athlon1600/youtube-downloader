<?php

namespace YouTube\Models;

use YouTube\Utils\Utils;

class YouTubeConfigData
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    protected function query($key)
    {
        return Utils::arrayGet($this->data, $key);
    }

    public function getGoogleVisitorId()
    {
        return $this->query('VISITOR_DATA');
    }

    public function getClientName()
    {
        return $this->query('INNERTUBE_CONTEXT_CLIENT_NAME');
    }

    public function getClientVersion()
    {
        return $this->query('INNERTUBE_CONTEXT_CLIENT_VERSION');
    }

    public function getApiKey()
    {
        return $this->query('INNERTUBE_API_KEY');
    }
}