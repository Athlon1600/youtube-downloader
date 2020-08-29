<?php

require('../vendor/autoload.php');

$url = isset($_POST['html']) ? $_POST['html'] : null;

if (!$url) {
    die("No html provided");
}

$youtube = new \YouTube\YouTubeDownloader();
$links = $youtube->getDownloadLinksFromHTML($url, true);

$error = $youtube->getLastError();

header('Content-Type: application/json');
echo json_encode([
    'links' => $links,
    'error' => $error
], JSON_PRETTY_PRINT);
