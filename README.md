<center>
  
![](https://img.shields.io/packagist/dt/Athlon1600/youtube-downloader.svg) ![](https://img.shields.io/github/last-commit/Athlon1600/youtube-downloader.svg) ![](https://img.shields.io/github/license/Athlon1600/youtube-downloader.svg)

</center>

# youtube-downloader

This project was inspired by a very popular youtube-dl python package:  
https://github.com/rg3/youtube-dl

Yes, there are multiple PHP-based youtube downloaders on the Internet, but all of them haven't been updated in years or they depend on youtube-dl.

This script does not depend on anything other than cURL. 
No Javascript interpreters, no calls to shell... nothing but pure PHP with no heavy dependencies either.

![](https://i.imgur.com/lW3OxvG.png?1)

That's all there is to it!

## :new: Update -- December 30, 2019!

Finally figured it out. 
As of right now, this is probably the only working 
PHP-based youtube downloader out there.

Demo
------

Just to prove its reliability and the fact that it works even with YouTube videos that encrypt their signature, visit this URL:  

https://api.unblockvideos.com/youtube_downloader?id=e-ORhEE9VVg&selector=mp4&code=secret  
  
Or stream it directly:

https://api.unblockvideos.com/youtube_downloader?id=e-ORhEE9VVg&selector=mp4&redirect=true&code=secret

~~Works with Age-Restricted videos too~~  

- TODO

Installation
-------

Recommended way of installing this is via [Composer](http://getcomposer.org):

```bash
composer require athlon1600/youtube-downloader
```

# Usage


```php
use YouTube\YouTubeDownloader;

$yt = new YouTubeDownloader();

$links = $yt->getDownloadLinks("https://www.youtube.com/watch?v=QxsmWxxouIM");

var_dump($links);
```

Result:  
```php
array(5) {
  [22]=>
  array(2) {
    ["url"]=>
    string(670) "https://r3---sn-vgqs7ney.googlevideo.com/videoplayback?ratebypass=yes&requiressl=yes&initcwndbps=1142500&nh=IgpwZjAxLm9yZDM1Kg42Ni4yMDguMjI4LjIwMQ&key=yt6&mime=video%2Fmp4&mn=sn-vgqs7ney&mm=31&id=o-APybfQxBq_Uf0UwtAWdBuT2hoXzus5lvuXnd9VSmh5Dl&ip=67.184.200.25&gcr=us&sparams=dur%2Cei%2Cgcr%2Cid%2Cinitcwndbps%2Cip%2Cipbits%2Citag%2Clmt%2Cmime%2Cmm%2Cmn%2Cms%2Cmv%2Cnh%2Cpl%2Cratebypass%2Crequiressl%2Csource%2Cupn%2Cexpire&mt=1482861742&ms=au&pl=16&itag=22&ei=Fq1iWM-PIsLyugLMor-gBA&mv=m&source=youtube&upn=pDkyvSW9InM&dur=265.357&ipbits=0&expire=1482883446&lmt=1478829845344913&signature=A27686411B20AD4EB61A29BC695509DB4D003681.9AE606614F809319EEE0B230BFCEFD09F5C39E12"
    ["format"]=>
    string(13) "MP4 720p (HD)"
  }
  [43]=>
  array(2) {
    ["url"]=>
    string(704) "https://r3---sn-vgqs7ney.googlevideo.com/videoplayback?ratebypass=yes&requiressl=yes&initcwndbps=1142500&nh=IgpwZjAxLm9yZDM1Kg42Ni4yMDguMjI4LjIwMQ&key=yt6&gir=yes&mime=video%2Fwebm&mn=sn-vgqs7ney&mm=31&id=o-APybfQxBq_Uf0UwtAWdBuT2hoXzus5lvuXnd9VSmh5Dl&clen=23934795&ip=67.184.200.25&gcr=us&sparams=clen%2Cdur%2Cei%2Cgcr%2Cgir%2Cid%2Cinitcwndbps%2Cip%2Cipbits%2Citag%2Clmt%2Cmime%2Cmm%2Cmn%2Cms%2Cmv%2Cnh%2Cpl%2Cratebypass%2Crequiressl%2Csource%2Cupn%2Cexpire&mt=1482861742&ms=au&pl=16&itag=43&ei=Fq1iWM-PIsLyugLMor-gBA&mv=m&source=youtube&upn=pDkyvSW9InM&dur=0.000&ipbits=0&expire=1482883446&lmt=1466552369088504&signature=4A9B43F989EF4DB937C56AC889BF9AFAA1363439.87B358B93A19E3C292BE823A2E7FD505E527956C"
    ["format"]=>
    string(9) "WebM 360p"
  }
  [18]=>
  array(2) {
    ["url"]=>
    string(705) "https://r3---sn-vgqs7ney.googlevideo.com/videoplayback?ratebypass=yes&requiressl=yes&initcwndbps=1142500&nh=IgpwZjAxLm9yZDM1Kg42Ni4yMDguMjI4LjIwMQ&key=yt6&gir=yes&mime=video%2Fmp4&mn=sn-vgqs7ney&mm=31&id=o-APybfQxBq_Uf0UwtAWdBuT2hoXzus5lvuXnd9VSmh5Dl&clen=18431345&ip=67.184.200.25&gcr=us&sparams=clen%2Cdur%2Cei%2Cgcr%2Cgir%2Cid%2Cinitcwndbps%2Cip%2Cipbits%2Citag%2Clmt%2Cmime%2Cmm%2Cmn%2Cms%2Cmv%2Cnh%2Cpl%2Cratebypass%2Crequiressl%2Csource%2Cupn%2Cexpire&mt=1482861742&ms=au&pl=16&itag=18&ei=Fq1iWM-PIsLyugLMor-gBA&mv=m&source=youtube&upn=pDkyvSW9InM&dur=265.357&ipbits=0&expire=1482883446&lmt=1478827692757115&signature=0C2203FABCEBC01A0B154C109EA7A03EBB778A17.7FFE657A41B06ABB4729E03253A92E1AA5562D3E"
    ["format"]=>
    string(8) "MP4 360p"
  }
  [36]=>
  array(2) {
    ["url"]=>
    string(677) "https://r3---sn-vgqs7ney.googlevideo.com/videoplayback?requiressl=yes&initcwndbps=1142500&nh=IgpwZjAxLm9yZDM1Kg42Ni4yMDguMjI4LjIwMQ&key=yt6&gir=yes&mime=video%2F3gpp&mn=sn-vgqs7ney&mm=31&id=o-APybfQxBq_Uf0UwtAWdBuT2hoXzus5lvuXnd9VSmh5Dl&clen=7400500&ip=67.184.200.25&gcr=us&sparams=clen%2Cdur%2Cei%2Cgcr%2Cgir%2Cid%2Cinitcwndbps%2Cip%2Cipbits%2Citag%2Clmt%2Cmime%2Cmm%2Cmn%2Cms%2Cmv%2Cnh%2Cpl%2Crequiressl%2Csource%2Cupn%2Cexpire&mt=1482861742&ms=au&pl=16&itag=36&ei=Fq1iWM-PIsLyugLMor-gBA&mv=m&source=youtube&upn=pDkyvSW9InM&dur=265.404&ipbits=0&expire=1482883446&lmt=1466551971126275&signature=121F4D6F18C10D31951E2C2A857E52351BCC1A8C.B6EFCCB6734190053A0F3980FC67D3E508EA30FF"
    ["format"]=>
    string(7) "Unknown"
  }
  [17]=>
  array(2) {
    ["url"]=>
    string(677) "https://r3---sn-vgqs7ney.googlevideo.com/videoplayback?requiressl=yes&initcwndbps=1142500&nh=IgpwZjAxLm9yZDM1Kg42Ni4yMDguMjI4LjIwMQ&key=yt6&gir=yes&mime=video%2F3gpp&mn=sn-vgqs7ney&mm=31&id=o-APybfQxBq_Uf0UwtAWdBuT2hoXzus5lvuXnd9VSmh5Dl&clen=2661359&ip=67.184.200.25&gcr=us&sparams=clen%2Cdur%2Cei%2Cgcr%2Cgir%2Cid%2Cinitcwndbps%2Cip%2Cipbits%2Citag%2Clmt%2Cmime%2Cmm%2Cmn%2Cms%2Cmv%2Cnh%2Cpl%2Crequiressl%2Csource%2Cupn%2Cexpire&mt=1482861742&ms=au&pl=16&itag=17&ei=Fq1iWM-PIsLyugLMor-gBA&mv=m&source=youtube&upn=pDkyvSW9InM&dur=265.404&ipbits=0&expire=1482883446&lmt=1466551946325771&signature=9C0017C6EE3EC754BCB73E4546483807143CC495.A738E50D2B2C9073E9369A8828BA780B6BA453F7"
    ["format"]=>
    string(8) "3GP 144p"
  }
}
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
