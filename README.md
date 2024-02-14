# YouTube Downloader

[![Build Status](https://github.com/ytdl-org/youtube-dl/workflows/CI/badge.svg)](https://github.com/ytdl-org/youtube-dl/actions?query=workflow%3ACI)
![](https://img.shields.io/github/license/Athlon1600/youtube-downloader.svg)
![](https://img.shields.io/packagist/dt/Athlon1600/youtube-downloader.svg)
![GitHub commit activity (branch)](https://img.shields.io/github/commit-activity/y/athlon1600/youtube-downloader)
![](https://img.shields.io/github/last-commit/Athlon1600/youtube-downloader.svg)

This project was inspired by a very popular youtube-dl python package:  
https://github.com/ytdl-org/youtube-dl

Yes, there are multiple other PHP-based youtube downloaders on the Internet, 
but most of them haven't been updated in years, or they depend on youtube-dl itself.  

Pure PHP-based youtube downloaders that work, and are **kept-up-to date** just do not exist.

This script uses no Javascript interpreters, no calls to shell... nothing but pure PHP with no heavy dependencies either.

![](https://i.imgur.com/YT39KZ5.png)

That's all there is to it!

## :warning: Legal Disclaimer

This program is for personal use only. 
Downloading copyrighted material without permission is against [YouTube's terms of services](https://www.youtube.com/static?template=terms). 
By using this program, you are solely responsible for any copyright violations. 
We are not responsible for people who attempt to use this program in any way that breaks YouTube's terms of services.

## Installation

Recommended way of installing this is via [Composer](http://getcomposer.org):

```bash
composer require athlon1600/youtube-downloader "^4.0"
```

## Example usage

```php
use YouTube\YouTubeDownloader;
use YouTube\Exception\YouTubeException;

$youtube = new YouTubeDownloader();

try {
    $downloadOptions = $youtube->getDownloadLinks("https://www.youtube.com/watch?v=aqz-KE-bpKQ");

    if ($downloadOptions->getAllFormats()) {
        echo $downloadOptions->getFirstCombinedFormat()->url;
    } else {
        echo 'No links found';
    }

} catch (YouTubeException $e) {
    echo 'Something went wrong: ' . $e->getMessage();
}
```

`getDownloadLinks` method returns a `DownloadOptions` type object, which holds an array of stream links - some that are audio-only, and some that are both audio and video combined into one.

For typical usage, you are probably interested in dealing with combined streams, for that case, there is the `getCombinedFormats` method.

## Other Features

- Stream YouTube videos directly from your server:

```php
$youtube = new \YouTube\YouTubeStreamer();
$youtube->stream('https://r4---sn-n4v7knll.googlevideo.com/videoplayback?...');
```

- Pass in your own cookies/user-agent

If you try downloading age-restricted videos, YouTube will ask you to login. The only way to make this work, is to login to your YouTube account in your own web-browser, export those newly set cookies from your browser into a file, and then pass it all to youtube-downloader for use.

```php
$youtube = new YouTubeDownloader();
$youtube->getBrowser()->setCookieFile('./your_cookies.txt');
$youtube->getBrowser()->setUserAgent('Opera 7.6');
```

See also:  
https://github.com/ytdl-org/youtube-dl/blob/master/README.md#how-do-i-pass-cookies-to-youtube-dl

- Before you continue to YouTube...

Depending on your region, you might be force redirected to a [page](https://unblockvideos.com/images/before-you-continue-cookies.jpg) that asks you to agree to Google's cookie policy.
You can programmatically agree to those terms, and bypass that warning permanently via `consentCookies` method on your Browser instance. Example:  
```php
$youtube = new YouTubeDownloader();
$youtube->getBrowser()->consentCookies();
```


## How does it work

A more detailed explanation on how to download videos from YouTube will be written soon.
For now, there is this:  

https://github.com/Athlon1600/youtube-downloader/pull/25#issuecomment-439373506

## Miscellaneous Links

- https://gitlab.futo.org/videostreaming/plugins/youtube
- https://tyrrrz.me/blog/reverse-engineering-youtube-revisited
- https://github.com/TeamNewPipe/NewPipeExtractor/blob/d83787a5ca308c4ca4e86e63a8b63c5e7c4708d6/extractor/src/main/java/org/schabi/newpipe/extractor/services/youtube/extractors/YoutubeStreamExtractor.java
- https://github.com/ytdl-org/youtube-dl/blob/master/youtube_dl/extractor/youtube.py
- https://github.com/yt-dlp/yt-dlp

## To-do list

- Allow downloading of private videos.
- Find a way to get around YouTube's throttling system that limits downloading speed to less than 100 kb/s for most most videos now...
- Add ability to solve YouTube Captcha and avoid `HTTP 429 Too Many Requests` errors.
- Add ability to download video and audio streams separately, and merge the two together using ffmpeg. Just like `youtube-dl` does!  
- Optional command that finds ALL video formats.
- ~~Fetch additional metadata about the video without using YouTube API.~~
