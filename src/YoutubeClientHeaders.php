<?php

namespace YouTube;

class YoutubeClientHeaders
{
    protected $clientName = 'ANDROID_EMBEDDED_PLAYER';
    protected $clientVersion = '17.31.35';

    public function getClientName()
    {
        return $this->clientName;
    }

    public function setClientName($clientName)
    {
        $this->clientName = $clientName;
    }

    public function getClientVersion()
    {
        return $this->clientVersion;
    }

    public function setClientVersion($clientVersion)
    {
        $this->clientVersion = $clientVersion;
    }
}