<?php

require('../vendor/autoload.php');

$url = isset($_GET['url']) ? $_GET['url'] : null;

if (!$url) {
    die("No url provided");
}

$youtube = new \YouTube\YouTubeDownloader();
$links = $youtube->getDownloadLinks($url);

$error = $youtube->getLastError();

header('Content-Type: application/json');
echo json_encode([
    'links' => $links,
    'error' => $error
], JSON_PRETTY_PRINT);
