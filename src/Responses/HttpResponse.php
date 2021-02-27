<?php

namespace YouTube\Responses;

use Curl\Response;

abstract class HttpResponse
{
    /**
     * @var Response
     */
    private $response;

    // Will become null if response contents cannot be decoded from JSON
    private $json;

    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->json = json_decode($response->body, true);
    }

    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return string|null
     */
    public function getResponseBody()
    {
        return $this->response->body;
    }

    /**
     * @return array|null
     */
    public function getJson()
    {
        return $this->json;
    }

    public function isStatusOkay()
    {
        return $this->getResponse()->status == 200;
    }
}
