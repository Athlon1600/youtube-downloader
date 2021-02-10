<?php

set_time_limit(0);

require('../vendor/autoload.php');

$url = isset($_GET['url']) ? $_GET['url'] : null;

if ($url == false) {
    die("No url provided");
}

$youtube = new \YouTube\YouTubeStreamer();
$youtube->stream($url);
