<?php

$fileToDownload = 'video.mp4';
$clientFile = 'video-example.mp4';

// download speed
$downloadRate = 120;

$f = null;

try {
    if (!file_exists('../download/' . $fileToDownload)) {
        throw new Exception('File ' . $fileToDownload . ' does not exist.');
    }

    if (!is_file('../download/' . $fileToDownload)) {
        throw new Exception('File ' . $fileToDownload . ' is not valid.');
    }

    header('Cache-control: private');
    header('Content-Type: video/mp4');
    header('Content-Length: ' . filesize('../download/' . $fileToDownload));
    header('Content-Disposition: attachment; filename=' . $clientFile);

    flush();

    $f = fopen('../download/' . $fileToDownload, 'r');

    while (!feof($f)) {
        print fread($f, round($downloadRate * 1024));

        flush();

        sleep(1);
    }
} catch (\Throwable $e) {
    echo $e->getMessage();
} finally {
    if ($f) {
        fclose($f);
    }
}