<?php

namespace YouTube;

// YouTube is capitalized twice because that's how youtube itself does it:
// https://developers.google.com/youtube/v3/code_samples/php
class YouTubeDownloader
{
    protected $client;

    /** @var string|null */
    protected $error;

    function __construct()
    {
        $this->client = new Browser();
    }

    public function getBrowser()
    {
        return $this->client;
    }

    public function getLastError()
    {
        return $this->error;
    }

    /**
     * Look for a player script URL. E.g:
     * <script src="//s.ytimg.com/yts/jsbin/player-fr_FR-vflHVjlC5/base.js" name="player/base"></script>
     *
     * @param $video_html
     * @return null|string
     */
    public function getPlayerScriptUrl($video_html)
    {
        $player_url = null;

        // check what player version that video is using
        if (preg_match('@<script\s*src="([^"]+player[^"]+js)@', $video_html, $matches)) {
            $player_url = $matches[1];

            // relative protocol?
            if (strpos($player_url, '//') === 0) {
                $player_url = 'http://' . substr($player_url, 2);
            } elseif (strpos($player_url, '/') === 0) {
                // relative path?
                $player_url = 'http://www.youtube.com' . $player_url;
            }
        }

        return $player_url;
    }

    public function getPlayerCode($player_url)
    {
        $contents = $this->client->getCached($player_url);
        return $contents;
    }

    // extract youtube video_id from any piece of text
    public function extractVideoId($str)
    {
        if (preg_match('/[a-z0-9_-]{11}/i', $str, $matches)) {
            return $matches[0];
        }

        return false;
    }

    /**
     * @param array $links
     * @param string $selector mp4, 360, etc...
     * @return array
     */
    private function selectFirst($links, $selector)
    {
        $result = array();
        $formats = preg_split('/\s*,\s*/', $selector);

        // has to be in this order
        foreach ($formats as $f) {

            foreach ($links as $l) {

                if (stripos($l['format'], $f) !== false || $f == 'any') {
                    $result[] = $l;
                }
            }
        }

        return $result;
    }

    // https://www.youtube.com/oembed?url=https://www.youtube.com/watch?v=JnfyjwChuNU&format=json
    public function getVideoInfo($video_id)
    {
        $response = $this->client->get("https://www.youtube.com/get_video_info?" . http_build_query([
                'video_id' => $video_id,
                'eurl' => 'https://youtube.googleapis.com/v/' . $video_id,
                'el' => 'embedded' // or detailpage. default: embedded, will fail if video is not embeddable
            ]));

        if ($response) {
            $arr = array();

            parse_str($response, $arr);

            if (array_key_exists('player_response', $arr)) {
                $arr['player_response'] = json_decode($arr['player_response'], true);
            }

            return $arr;
        }

        return null;
    }

    public function getPlayerConfig($video_id)
    {
        $video_id = $this->extractVideoId($video_id);
        $response = $this->client->get("https://www.youtube.com/watch?v={$video_id}");

        if (preg_match('/ytplayer.config\s*=\s*([^\n]+});ytplayer/i', $response, $matches)) {
            return json_decode($matches[1], true);
        }

        return [];
    }

    public function getPageHtml($url)
    {
        $video_id = $this->extractVideoId($url);
        return $this->client->get("https://www.youtube.com/watch?v={$video_id}");
    }

    public function getPlayerResponse($page_html)
    {
        if (preg_match('/player_response":"(.*?)","/', $page_html, $matches)) {
            $match = stripslashes($matches[1]);

            $ret = json_decode($match, true);
            return $ret;
        }

        return null;
    }

    public function parsePlayerResponse($player_response, $js_code)
    {
        $parser = new Parser();

        try {

            $formats = Utils::arrayGet($player_response, 'streamingData.formats', []);

            // video only or audio only streams
            $adaptiveFormats = Utils::arrayGet($player_response, 'streamingData.adaptiveFormats', []);

            $formats_combined = array_merge($formats, $adaptiveFormats);

            // final response
            $return = array();

            foreach ($formats_combined as $item) {

                // sometimes as appear as "cipher" or "signatureCipher"
                $cipher = Utils::arrayGet($item, 'cipher', Utils::arrayGet($item, 'signatureCipher', ''));
                $itag = $item['itag'];

                // some videos do not need to be decrypted!
                if (isset($item['url'])) {

                    $return[] = array(
                        'url' => $item['url'],
                        'itag' => $itag,
                        'format' => $parser->parseItagInfo($itag)
                    );

                    continue;
                }

                parse_str($cipher, $result);

                $url = $result['url'];
                $sp = $result['sp']; // typically 'sig'
                $signature = $result['s'];

                $decoded_signature = (new SignatureDecoder())->decode($signature, $js_code);

                // redirector.googlevideo.com
                $return[] = array(
                    'url' => $url . '&' . $sp . '=' . $decoded_signature,
                    'itag' => $itag,
                    'format' => $parser->parseItagInfo($itag)
                );
            }

            return $return;

        } catch (\Exception $exception) {
            // do nothing
        } catch (\Throwable $throwable) {
            // do nothing
        }

        return null;
    }

    public function getDownloadLinks($video_id, $selector = false)
    {
        $this->error = null;

        $page_html = $this->getPageHtml($video_id);

        if (strpos($page_html, 'We have been receiving a large volume of requests') !== false ||
            strpos($page_html, 'systems have detected unusual traffic') !== false ||
            strpos($page_html, '/recaptcha/') !== false) {

            $this->error = 'HTTP 429: Too many requests.';

            return array();
        }

        // get JSON encoded parameters that appear on video pages
        $json = $this->getPlayerResponse($page_html);

        // get player.js location that holds signature function
        $url = $this->getPlayerScriptUrl($page_html);
        $js = $this->getPlayerCode($url);

        $result = $this->parsePlayerResponse($json, $js);

        // if error happens
        if (!is_array($result)) {
            return array();
        }

        // do we want all links or just select few?
        if ($selector) {
            return $this->selectFirst($result, $selector);
        }

        return $result;
    }
}
