<?php

namespace YouTube;

use YouTube\Models\StreamFormat;
use YouTube\Responses\PlayerApiResponse;
use YouTube\Responses\VideoPlayerJs;
use YouTube\Utils\Utils;

class PlayerResponseParser
{
    /**
     * @var PlayerApiResponse
     */
    private $response;

    /** @var VideoPlayerJs */
    protected $videoPlayerJs;

    protected function __construct(PlayerApiResponse $response)
    {
        $this->response = $response;
    }

    public static function createFrom(PlayerApiResponse $playerApiResponse)
    {
        return new static($playerApiResponse);
    }

    public function setPlayerJsResponse(VideoPlayerJs $videoPlayerJs)
    {
        $this->videoPlayerJs = $videoPlayerJs;
    }

    /**
     * @return StreamFormat[]
     */
    public function parseLinks($signatureDecrypter = null)
    {
        $formats_combined = $this->response->getAllFormats();

        // final response
        $return = array();

        foreach ($formats_combined as $format) {

            // appear as either "cipher" or "signatureCipher"
            $cipher = Utils::arrayGet($format, 'cipher', Utils::arrayGet($format, 'signatureCipher', ''));

            // some videos do not need to be decrypted!
            if (isset($format['url'])) {
                $return[] = new StreamFormat($format);
                continue;
            }

            $cipherArray = Utils::parseQueryString($cipher);

            $url = Utils::arrayGet($cipherArray, 'url');
            $sp = Utils::arrayGet($cipherArray, 'sp'); // used to be 'sig'
            $signature = Utils::arrayGet($cipherArray, 's');

            $streamUrl = new StreamFormat($format);

            if ($this->videoPlayerJs) {

                $decoded_signature = (new SignatureDecoder())->decode($signature, $this->videoPlayerJs->getResponseBody());
                $decoded_url = $url . '&' . $sp . '=' . $decoded_signature;

                $streamUrl->url = $decoded_url;

            } else {
                $streamUrl->url = $url;
            }

            $return[] = $streamUrl;
        }

        return $return;
    }
}