<?php

namespace YouTube\Models;

class YouTubeConfigData extends JsonObject
{
    public function getGoogleVisitorId(): ?string
    {
        return $this->deepGet('VISITOR_DATA');
    }

    public function getClientName(): ?string
    {
        return $this->deepGet('INNERTUBE_CONTEXT_CLIENT_NAME');
    }

    public function getClientVersion(): ?string
    {
        return $this->deepGet('INNERTUBE_CONTEXT_CLIENT_VERSION');
    }

    public function getApiKey(): ?string
    {
        return $this->deepGet('INNERTUBE_API_KEY');
    }
}