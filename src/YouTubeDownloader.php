<?php

namespace YouTube;

// YouTube is capitalized twice because that's how youtube itself does it:
// https://developers.google.com/youtube/v3/code_samples/php
class YouTubeDownloader
{
    private $storage_dir;
    private $cookie_dir;

    private $client;

    private $itag_info = array(
        5 => "FLV 400x240",
        6 => "FLV 450x240",
        13 => "3GP Mobile",
        17 => "3GP 144p",
        18 => "MP4 360p",
        22 => "MP4 720p (HD)",
        34 => "FLV 360p",
        35 => "FLV 480p",
        36 => "3GP 240p",
        37 => "MP4 1080",
        38 => "MP4 3072p",
        43 => "WebM 360p",
        44 => "WebM 480p",
        45 => "WebM 720p",
        46 => "WebM 1080p",
        59 => "MP4 480p",
        78 => "MP4 480p",
        82 => "MP4 360p 3D",
        83 => "MP4 480p 3D",
        84 => "MP4 720p 3D",
        85 => "MP4 1080p 3D",
        91 => "MP4 144p",
        92 => "MP4 240p HLS",
        93 => "MP4 360p HLS",
        94 => "MP4 480p HLS",
        95 => "MP4 720p HLS",
        96 => "MP4 1080p HLS",
        100 => "WebM 360p 3D",
        101 => "WebM 480p 3D",
        102 => "WebM 720p 3D",
        120 => "WebM 720p 3D",
        127 => "TS Dash Audio 96kbps",
        128 => "TS Dash Audio 128kbps"
    );

    function __construct()
    {
        $this->storage_dir = sys_get_temp_dir();
        $this->cookie_dir = sys_get_temp_dir();

        $this->client = new Browser();
    }

    function setStorageDir($dir)
    {
        $this->storage_dir = $dir;
    }

    // if URL: download it
    private function toHtml($html)
    {

    }

    // accepts either raw HTML or url
    // <script src="//s.ytimg.com/yts/jsbin/player-fr_FR-vflHVjlC5/base.js" name="player/base"></script>
    public function getPlayerUrl($video_html)
    {
        if (strpos($video_html, 'http') === 0) {
            $video_html = $this->client->get($video_html);
        }

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

    // Do not redownload player.js everytime - cache it
    public function getPlayerHtml($video_html)
    {
        $player_url = $this->getPlayerUrl($video_html);

        $cache_path = sprintf('%s/%s', $this->storage_dir, md5($player_url));

        if (file_exists($cache_path)) {
            $contents = file_get_contents($cache_path);
            //return unserialize($contents);
        }

        $contents = $this->client->get($player_url);

        // cache it too!
        file_put_contents($cache_path, serialize($contents));

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

    // selector by format: mp4 360,
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

    // some of the data may need signature decoding
    public function parseStreamMap($video_html, $video_id)
    {
        $stream_map = array();
        $result = array();

        // http://stackoverflow.com/questions/35608686/how-can-i-get-the-actual-video-url-of-a-youtube-live-stream
        if (preg_match('@url_encoded_fmt_stream_map["\']:\s*["\']([^"\'\s]*)@', $video_html, $matches)) {
            $stream_map = $matches[1];
        } else {

            $gvi = $this->client->get("https://www.youtube.com/get_video_info?el=embedded&eurl=https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3D" . urlencode($video_id) . "&video_id={$video_id}");

            if (preg_match('@url_encoded_fmt_stream_map=([^\&\s]+)@', $gvi, $matches_gvi)) {
                $stream_map = urldecode($matches_gvi[1]);
            }
        }

        if ($stream_map) {
            $parts = explode(",", $stream_map);

            foreach ($parts as $p) {
                $query = str_replace('\u0026', '&', $p);
                parse_str($query, $arr);

                $result[] = $arr;
            }

            return $result;
        }

        // TODO:
        // elseif (strpos($html, 'player-age-gate-content') !== false) { // age-gate
        // youtube must have changed something
        return $result;
    }

    // options | deep_links | append_redirector
    // TODO: make it accept video_html too
    public function getDownloadLinks($video_id, $selector = false)
    {
        // you can input HTML of /watch? page directory instead of id
        $video_id = $this->extractVideoId($video_id);

        $video_html = $this->client->get("https://www.youtube.com/watch?v={$video_id}");
        $player_html = $this->getPlayerHtml($video_html);

        $result = array();
        $url_map = $this->parseStreamMap($video_html, $video_id);

        foreach ($url_map as $arr) {
            $url = $arr['url'];

            if (isset($arr['sig'])) {
                $url = $url . '&signature=' . $arr['sig'];

            } elseif (isset($arr['signature'])) {
                $url = $url . '&signature=' . $arr['signature'];

            } elseif (isset($arr['s'])) {

                $signature = (new SignatureDecoder())->decode($arr['s'], $player_html);
                $url = $url . '&signature=' . $signature;
            }

            // redirector.googlevideo.com
            //$url = preg_replace('@(\/\/)[^\.]+(\.googlevideo\.com)@', '$1redirector$2', $url);

            $itag = $arr['itag'];
            $format = isset($this->itag_info[$itag]) ? $this->itag_info[$itag] : 'Unknown';

            $result[$itag] = array(
                'url' => $url,
                'format' => $format
            );
        }

        // do we want all links or just select few?
        if ($selector) {
            return $this->selectFirst($result, $selector);
        }

        return $result;
    }
}

