<?php

require_once './vendor/autoload.php';

$yt = new \AdemOzmermer\Platform\YouTube();

$yt->url('https://www.youtube.com/watch?v=EWOeoewRYqM');
$yt->extension('mp3'); // Specify audio format: "best", "aac", "flac", "mp3", "m4a", "opus", "vorbis", or "wav"; "best"
// $yt->proxy('127.0.0.1:5555'); // Optional proxy url
$yt->limit('30M'); // Do not download any videos larger than SIZE

print_r($yt->download('/download'));  // Directory to download
