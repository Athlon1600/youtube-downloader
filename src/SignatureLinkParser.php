<?php

namespace YouTube;

use YouTube\Models\StreamFormat;
use YouTube\Responses\PlayerApiResponse;
use YouTube\Responses\VideoPlayerJs;
use YouTube\Utils\Utils;

class SignatureLinkParser
{
    /**
     * @param PlayerApiResponse $apiResponse
     * @param VideoPlayerJs|null $playerJs
     * @return StreamFormat[]
     */
    public static function parseLinks(PlayerApiResponse $apiResponse, ?VideoPlayerJs $playerJs = null): array
    {
        $formats_combined = $apiResponse->getAllFormats();

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

            // contains ?ip noting which IP can access it, and ?expire containing link expiration timestamp
            $url = Utils::arrayGet($cipherArray, 'url');
            $sp = Utils::arrayGet($cipherArray, 'sp'); // used to be 'sig'

            // needs to be decrypted!
            $signature = Utils::arrayGet($cipherArray, 's');

            $streamUrl = new StreamFormat($format);

            if ($playerJs) {

                $decoded_signature = (new SignatureDecoder())->decode($signature, $playerJs->getResponseBody());
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