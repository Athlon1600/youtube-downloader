<?php

require('../vendor/autoload.php');

$url = isset($_GET['url']) ? $_GET['url'] : null;

if (!$url) {
    die("No url provided");
}


if($_GET['url']){
if(preg_match('/(http(s|):|)\/\/(www\.|)yout(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $url)){
			function getYoutubeIdFromUrl($url) {
    $parts = parse_url($url);
    if(isset($parts['query'])){
        parse_str($parts['query'], $qs);
        if(isset($qs['v'])){
            return $qs['v'];
        }else if(isset($qs['vi'])){
            return $qs['vi'];
        }}}}
    }
      $id = getYoutubeIdFromUrl($url);


$getinfo = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id=".$id."&key=AIzaSyAAr5xTBdLRiIUMvJPK4vUUEH6VlNwRiZY"))->items[0];
$title = $getinfo->snippet->title;
$view_count = $getinfo->statistics->viewCount;
$duration = $getinfo->contentDetails->duration;
$like_count = $getinfo->statistics->likeCount;
$dislike_count = $getinfo->statistics->dislikeCount;


$youtube = new \YouTube\YouTubeDownloader();
$links = $youtube->getDownloadLinks($url);

$error = $youtube->getLastError();


$VidDuration = $getinfo->contentDetails->duration;
function covtime($yt){
    $yt=str_replace(['P','T'],'',$yt);
    foreach(['D','H','M','S'] as $a){
        $pos=strpos($yt,$a);
        if($pos!==false) ${$a}=substr($yt,0,$pos); else { ${$a}=0; continue; }
        $yt=substr($yt,$pos+1);
    }
    if($D>0){
        $M=str_pad($M,2,'0',STR_PAD_LEFT);
        $S=str_pad($S,2,'0',STR_PAD_LEFT);
        return ($H+(24*$D)).":$M:$S"; // add days to hours
    } elseif($H>0){
        $M=str_pad($M,2,'0',STR_PAD_LEFT);
        $S=str_pad($S,2,'0',STR_PAD_LEFT);
        return "$H:$M:$S";
    } else {
        $S=str_pad($S,2,'0',STR_PAD_LEFT);
        return "$M:$S";
    }
}


$bitrate = $links[0]["sizebet"];




if ($bitrate >= 1073741824) {
            $bitrate = number_format($bitrate / 1073741824, 2) . ' GB';
        } elseif ($bitrate >= 1048576) {
            $bitrate = number_format($bitrate / 1048576, 2) . ' MB';
        } elseif ($bitrate >= 1024) {
            $bitrate = number_format($bitrate / 1024, 2) . ' KB';
        } elseif ($bitrate > 1) {
            $bitrate = $bitrate . ' bytes';
        } elseif ($bitrate === 1) {
            $bitrate = $bitrate . ' byte';
        } else {
            $bitrate = '0 bytes';
        }
        $kb = (int)$bitrate;






header('Content-Type: application/json; charset=utf-8');


$result = [
    'url' => $links[0]["url"],
    'sizebet' => $links[0]["sizebet"],
    'title' => $title,
    'view_count' => $view_count,
    'duration' => covtime($VidDuration),
    'like_count' => $like_count,
    'dislike_count' => $dislike_count,
    'size' => $bitrate,
    'Name API' => "AymanEGY",
];

$decode = array('ok'=>true,'result'=>$result);
if($decode){
Echo json_encode($decode,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}
