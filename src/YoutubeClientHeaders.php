<?php

namespace YouTube;

class YoutubeClientHeaders
{
    protected string $clientName = "ANDROID";
    protected string $clientVersion = "19.10.38";

    public function setClientName(string $clientName): void
    {
        $this->clientName = $clientName;
    }

    public function setClientVersion(string $clientVersion): void
    {
        $this->clientVersion = $clientVersion;
    }

    public function getClient(): array
    {
        return [
            "androidSdkVersion" => 34,
            "clientName" => $this->clientName,
            "clientVersion" => $this->clientVersion,
            "hl" => "en",
            "timeZone" => "UTC",
            "userAgent" => $this->getUserAgent(),
            "utcOffsetMinutes" => 0,
        ];
    }

    public function getUserAgent(): string
    {
        return "com.google.android.youtube/{$this->clientVersion} (Linux; U; Android 14) gzip";
    }
}
