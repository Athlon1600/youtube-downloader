<?php

namespace YouTube;

class YoutubeClientHeaders
{
    protected string $clientName = 'ANDROID_EMBEDDED_PLAYER';
    protected string $clientVersion = '17.31.35';

    public function getClientName(): string
    {
        return $this->clientName;
    }

    public function setClientName($clientName): void
    {
        $this->clientName = $clientName;
    }

    public function getClientVersion(): string
    {
        return $this->clientVersion;
    }

    public function setClientVersion($clientVersion): void
    {
        $this->clientVersion = $clientVersion;
    }
}