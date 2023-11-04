<?php

namespace YouTube\Responses;

use Curl\Response;

abstract class HttpResponse
{
    /**
     * @var Response
     */
    private Response $response;

    // Will become null if response contents cannot be decoded from JSON
    private ?array $json;

    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->json = json_decode($response->body, true);
    }

    public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     * @return string|null
     */
    public function getResponseBody(): ?string
    {
        return $this->response->body;
    }

    /**
     * @return array|null
     */
    public function getJson(): ?array
    {
        return $this->json;
    }

    public function isStatusOkay(): bool
    {
        return $this->getResponse()->status == 200;
    }
}
