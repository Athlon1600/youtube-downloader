<center>
  
![](https://img.shields.io/packagist/dt/Athlon1600/youtube-downloader.svg) ![](https://img.shields.io/github/last-commit/Athlon1600/youtube-downloader.svg) ![](https://img.shields.io/github/license/Athlon1600/youtube-downloader.svg)

</center>

# youtube-downloader

This project was inspired by a very popular youtube-dl python package:  
https://github.com/rg3/youtube-dl

Yes, there are multiple other PHP-based youtube downloaders on the Internet, 
but most of them haven't been updated in years, or they depend on youtube-dl itself.  

Pure PHP-based youtube downloaders that work, and are **kept-up-to date** just do not exist.

This script does not depend on anything other than cURL. 
No Javascript interpreters, no calls to shell... nothing but pure PHP with no heavy dependencies either.

![](https://i.imgur.com/lW3OxvG.png?1)

That's all there is to it!


## Demo App

This may not work at all times, because YouTube puts a short ban on the server if it receives too many requests from it.

- https://youtube-downloader3.herokuapp.com/

![](http://proxynova.s3.amazonaws.com/youtube-downloader-save-video.png)


### Deploy your own App

on Heroku:

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy)


Create a FREE account first if you do not yet have one:  
https://signup.heroku.com/

Installation
-------

Recommended way of installing this is via [Composer](http://getcomposer.org):

```bash
composer require athlon1600/youtube-downloader
```

Run locally:

```bash
php -S localhost:8000 -t vendor/athlon1600/youtube-downloader/public
```


# Usage


```php
use YouTube\YouTubeDownloader;

$yt = new YouTubeDownloader();

$links = $yt->getDownloadLinks("https://www.youtube.com/watch?v=LJzCYSdrHMI");

var_dump($links);
```

Typical output:

```php
array(13) {
  [0]=>
  array(3) {
    ["url"]=>
    string(820) "https://r4---sn-vgqsrn7s.googlevideo.com/videoplayback?expire=1585718912&ei=INKDXr7sA5PdwQGk5L_wBA&ip=73.44.159.175&id=o-APOJXNOviU0h2w_YwyR88MKLSLJ1Bx77faGZYYK0LJMt&itag=18&source=youtube&requiressl=yes&mh=hA&mm=31%2C29&mn=sn-vgqsrn7s%2Csn-vgqskne6&ms=au%2Crdu&mv=m&mvi=3&pl=15&initcwndbps=1702500&vprv=1&mime=video%2Fmp4&gir=yes&clen=15386550&ratebypass=yes&dur=215.550&lmt=1540977373739457&mt=1585697193&fvip=4&c=WEB&txp=5431432&sparams=expire%2Cei%2Cip%2Cid%2Citag%2Csource%2Crequiressl%2Cvprv%2Cmime%2Cgir%2Cclen%2Cratebypass%2Cdur%2Clmt&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl%2Cinitcwndbps&lsig=ABSNjpQwRgIhAMo7U4XgSR09Ztya4aqGq07jdb62Zbk1z6yUtuzimRKoAiEAofZdslUJXvV4apnRzFCtpSx_Ki0qZs41BsctbtyUvo0%3D&sig=ADKhkGMwRQIgapMHgteEaTdLUhadRXmpm0F6hiexTsXwCwVNQK2XV4MCIQC012rLqDUxmlqdKwcd9JIi_vQ9_jczWBTf7wZw4KzYNg=="
    ["itag"]=>
    int(18)
    ["format"]=>
    string(23) "mp4, video, 360p, audio"
  }
  [1]=>
  array(3) {
    ["url"]=>
    string(862) "https://r4---sn-vgqsrn7s.googlevideo.com/videoplayback?expire=1585718912&ei=INKDXr7sA5PdwQGk5L_wBA&ip=73.44.159.175&id=o-APOJXNOviU0h2w_YwyR88MKLSLJ1Bx77faGZYYK0LJMt&itag=135&aitags=133%2C134%2C135%2C160%2C242%2C243%2C244%2C278&source=youtube&requiressl=yes&mh=hA&mm=31%2C29&mn=sn-vgqsrn7s%2Csn-vgqskne6&ms=au%2Crdu&mv=m&mvi=3&pl=15&initcwndbps=1702500&vprv=1&mime=video%2Fmp4&gir=yes&clen=16811068&dur=215.480&lmt=1540977822655178&mt=1585697193&fvip=4&keepalive=yes&c=WEB&txp=5432432&sparams=expire%2Cei%2Cip%2Cid%2Caitags%2Csource%2Crequiressl%2Cvprv%2Cmime%2Cgir%2Cclen%2Cdur%2Clmt&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl%2Cinitcwndbps&lsig=ABSNjpQwRgIhAMo7U4XgSR09Ztya4aqGq07jdb62Zbk1z6yUtuzimRKoAiEAofZdslUJXvV4apnRzFCtpSx_Ki0qZs41BsctbtyUvo0%3D&sig=ADKhkGMwRQIgYmZ3IRKrmcEpLAoKMkL-534wd4F34esToX0DJFsv5-4CIQDfEevpFMn57t3-Tidx5VHraC9QS24y-fUgWqWzNvoxag=="
    ["itag"]=>
    int(135)
    ["format"]=>
    string(16) "mp4, video, 480p"
  }
  [2]=>
  array(3) {
    ["url"]=>
    string(863) "https://r4---sn-vgqsrn7s.googlevideo.com/videoplayback?expire=1585718912&ei=INKDXr7sA5PdwQGk5L_wBA&ip=73.44.159.175&id=o-APOJXNOviU0h2w_YwyR88MKLSLJ1Bx77faGZYYK0LJMt&itag=244&aitags=133%2C134%2C135%2C160%2C242%2C243%2C244%2C278&source=youtube&requiressl=yes&mh=hA&mm=31%2C29&mn=sn-vgqsrn7s%2Csn-vgqskne6&ms=au%2Crdu&mv=m&mvi=3&pl=15&initcwndbps=1702500&vprv=1&mime=video%2Fwebm&gir=yes&clen=12496451&dur=215.480&lmt=1540977711684149&mt=1585697193&fvip=4&keepalive=yes&c=WEB&txp=5432432&sparams=expire%2Cei%2Cip%2Cid%2Caitags%2Csource%2Crequiressl%2Cvprv%2Cmime%2Cgir%2Cclen%2Cdur%2Clmt&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl%2Cinitcwndbps&lsig=ABSNjpQwRgIhAMo7U4XgSR09Ztya4aqGq07jdb62Zbk1z6yUtuzimRKoAiEAofZdslUJXvV4apnRzFCtpSx_Ki0qZs41BsctbtyUvo0%3D&sig=ADKhkGMwRQIhAOLXVJMMW8zKJm1Moug94ak57hijQ3HAKnIu6y8mZtyiAiBs9kY_wHtiAd3rg4891X7aBJiqzDyEoxaVCodWeJt9hQ=="
    ["itag"]=>
    int(244)
    ["format"]=>
    string(17) "webm, video, 480p"
  },
  ...
}
```

If you are looking for links that include both video and audio in a single file, 
then filter down that list to look for links that contain both `video` and `audio` inside its `format` property.

## Other Features

- Stream YouTube videos directly from your server:

```php
$youtube = new \YouTube\YouTubeStreamer();
$youtube->stream('https://r4---sn-n4v7knll.googlevideo.com/videoplayback?...');
```


## How does it work

A more detailed explanation on how to download videos from YouTube will be written soon.
For now, there is this:  

https://github.com/Athlon1600/youtube-downloader/pull/25#issuecomment-439373506

## Other Links

https://github.com/TeamNewPipe/NewPipeExtractor/blob/d83787a5ca308c4ca4e86e63a8b63c5e7c4708d6/extractor/src/main/java/org/schabi/newpipe/extractor/services/youtube/extractors/YoutubeStreamExtractor.java

https://github.com/ytdl-org/youtube-dl/blob/master/youtube_dl/extractor/youtube.py

## To-do list

- Optional command that finds ALL video formats.
- Fetch additional metadata about the video without using YouTube API.
