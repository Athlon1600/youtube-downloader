<center>
  
![](https://img.shields.io/packagist/dt/Athlon1600/youtube-downloader.svg) ![](https://img.shields.io/github/last-commit/Athlon1600/youtube-downloader.svg) ![](https://img.shields.io/github/license/Athlon1600/youtube-downloader.svg)

</center>

# youtube-downloader

This project was inspired by a very popular youtube-dl python package:  
https://github.com/rg3/youtube-dl ([**which has been very recently removed from github**](https://news.ycombinator.com/item?id=24872911))

Yes, there are multiple other PHP-based youtube downloaders on the Internet, 
but most of them haven't been updated in years, or they depend on youtube-dl itself.  

Pure PHP-based youtube downloaders that work, and are **kept-up-to date** just do not exist.

This script does not depend on anything other than cURL. 
No Javascript interpreters, no calls to shell... nothing but pure PHP with no heavy dependencies either.

![](https://i.imgur.com/lW3OxvG.png?1)

That's all there is to it!

## :warning: Legal Disclaimer

This program is for personal use only. 
Downloading copyrighted material without permission is against [YouTube's terms of services](https://www.youtube.com/static?template=terms). 
By using this program, you are solely responsible for any copyright violations. 
We are not responsible for people who attempt to use this program in any way that breaks YouTube's terms of services.

## Demo App

This may not work at all times, because YouTube puts a short ban on the server if it receives too many requests from it.

- https://youtube-downloader3.herokuapp.com/

![](http://proxynova.s3.us-east-1.amazonaws.com/youtube-downloader-save-video.png)


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

$links = $yt->getDownloadLinks("https://www.youtube.com/watch?v=aqz-KE-bpKQ");

var_dump($links);
```

Typical output:

```php
array(34) {
  [0]=>
  array(3) {
    ["url"]=>
    string(818) "https://r2---sn-vgqsrnll.googlevideo.com/videoplayback?expire=1603662577&ei=kZ6VX4bVKsX2igTRw7bYDA&ip=73.44.159.175&id=o-AAp5zheuntq2b_3xaazjawoVuUu81dOj4UMFCwvobO6S&itag=18&source=youtube&requiressl=yes&mh=aP&mm=31
%2C26&mn=sn-vgqsrnll%2Csn-p5qlsndd&ms=au%2Conr&mv=m&mvi=2&pl=15&initcwndbps=1850000&vprv=1&mime=video%2Fmp4&gir=yes&clen=47526444&ratebypass=yes&dur=634.624&lmt=1544610273905877&mt=1603640800&fvip=2&c=WEB&txp=5531432&sparams=expire%
2Cei%2Cip%2Cid%2Citag%2Csource%2Crequiressl%2Cvprv%2Cmime%2Cgir%2Cclen%2Cratebypass%2Cdur%2Clmt&sig=AOq0QJ8wRAIgaXRmqTcfpJyamC35s18BJagdAX2qbzdOxENTvpvJf94CICZpv5_A6lzAIEynLJSP_a2gNj1YuXGDpVawA5Tr1avo&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv
%2Cmvi%2Cpl%2Cinitcwndbps&lsig=AG3C_xAwRQIhALWRQA0bvSWj-PQoydPqIWp6_5tFDBEmG98sC_MU7lSkAiBupuCcN4GBLPUs-_efbHiuorh_1VIRqW-yu5qATnXyGQ%3D%3D"
    ["itag"]=>
    int(18)
    ["format"]=>
    string(23) "mp4, video, 360p, audio"
  }
  [1]=>
  array(3) {
    ["url"]=>
    string(783) "https://r2---sn-vgqsrnll.googlevideo.com/videoplayback?expire=1603662577&ei=kZ6VX4bVKsX2igTRw7bYDA&ip=73.44.159.175&id=o-AAp5zheuntq2b_3xaazjawoVuUu81dOj4UMFCwvobO6S&itag=22&source=youtube&requiressl=yes&mh=aP&mm=31
%2C26&mn=sn-vgqsrnll%2Csn-p5qlsndd&ms=au%2Conr&mv=m&mvi=2&pl=15&initcwndbps=1850000&vprv=1&mime=video%2Fmp4&ratebypass=yes&dur=634.624&lmt=1544610886483826&mt=1603640800&fvip=2&c=WEB&txp=5532432&sparams=expire%2Cei%2Cip%2Cid%2Citag%
2Csource%2Crequiressl%2Cvprv%2Cmime%2Cratebypass%2Cdur%2Clmt&sig=AOq0QJ8wRAIgSq2NECUHbKyWFOpqecNWJuyHWtv2zyTM-dmaoTeSxAwCIAwhJWN7ttYJCfJgkS91BsgzRpCg_c82ZJzOlS6PNdX3&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl%2Cinitcwndbps&lsig=AG3C
_xAwRQIhALWRQA0bvSWj-PQoydPqIWp6_5tFDBEmG98sC_MU7lSkAiBupuCcN4GBLPUs-_efbHiuorh_1VIRqW-yu5qATnXyGQ%3D%3D"
    ["itag"]=>
    int(22)
    ["format"]=>
    string(23) "mp4, video, 720p, audio"
  }
  [2]=>
  array(3) {
    ["url"]=>
    string(977) "https://r2---sn-vgqsrnll.googlevideo.com/videoplayback?expire=1603662577&ei=kZ6VX4bVKsX2igTRw7bYDA&ip=73.44.159.175&id=o-AAp5zheuntq2b_3xaazjawoVuUu81dOj4UMFCwvobO6S&itag=313&aitags=133%2C134%2C135%2C136%2C137%2C160
%2C242%2C243%2C244%2C247%2C248%2C271%2C278%2C298%2C299%2C302%2C303%2C308%2C313%2C315%2C394%2C395%2C396%2C397%2C398%2C399&source=youtube&requiressl=yes&mh=aP&mm=31%2C26&mn=sn-vgqsrnll%2Csn-p5qlsndd&ms=au%2Conr&mv=m&mvi=2&pl=15&initcw
ndbps=1850000&vprv=1&mime=video%2Fwebm&gir=yes&clen=1031056722&dur=634.566&lmt=1544610999847472&mt=1603640800&fvip=2&keepalive=yes&c=WEB&txp=5532432&sparams=expire%2Cei%2Cip%2Cid%2Caitags%2Csource%2Crequiressl%2Cvprv%2Cmime%2Cgir%2C
clen%2Cdur%2Clmt&sig=AOq0QJ8wRgIhAOdypA3IhD7p8dI3blHQ5n9KG1ClwU6ZPwwlK4CWYn7XAiEAgnPJSrG2efjxMNrZazEgk2yb2k_gO1cerel30CJRV9w%3D&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl%2Cinitcwndbps&lsig=AG3C_xAwRQIhALWRQA0bvSWj-PQoydPqIWp6_5tFDB
EmG98sC_MU7lSkAiBupuCcN4GBLPUs-_efbHiuorh_1VIRqW-yu5qATnXyGQ%3D%3D"
    ["itag"]=>
    int(313)
    ["format"]=>
    string(18) "webm, video, 2160p"
  }
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

- Add ability to solve YouTube Captcha and avoid `HTTP 429 Too Many Requests` errors.
- Add ability to download video and audio streams separately, and merge the two together using ffmpeg. Just like `youtube-dl` does!  
- Optional command that finds ALL video formats.
- Fetch additional metadata about the video without using YouTube API.
