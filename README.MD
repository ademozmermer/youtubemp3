# YouTube mp3 downloader
Converts Youtube videos to music format and downloads to your server

  - Supports proxy
  - Specify audio format: best, aac, flac, mp3, m4a, opus, vorbis, or wav (ffmpeg is required)


### Using
```
require_once './vendor/autoload.php';

$yt = new \AdemOzmermer\Platform\YouTube();

$yt->url('https://www.youtube.com/watch?v=KJjYymEwpPE');
$yt->extension('mp3'); 
$yt->proxy('127.0.0.1:5555'); // Optional proxy url
$yt->limit('30M'); // Do not download any videos larger than SIZE

print_r($yt->download('/download'));  // Directory to download
```
### Installation

```sh
$ composer require ademozmermer/youtubemp3
```

License
----

MIT