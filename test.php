<?php

require_once 'vendor/autoload.php';
use anhnguyenbk\PHPLivestream\LivestreamServiceFactory;

$livestreamServiceFactory = new LivestreamServiceFactory();

$apiKey = 'b0kkpfcpSxqX-p9T-2nNVQ';
$apiSecret = 'vW2vMphcJ2eDHjJAPkCbScJnJpjvKtvEil3x';

$zoomService = $livestreamServiceFactory->createZoomService ($apiKey, $apiSecret);

$livestream->topic = "Example livestream topic";
$livestream->startTime = "2021-05-31T20:30:00";
$livestream->duration = "60";
$livestream->password = "111111";

$response = $zoomService->createLivestream($livestream);
print (json_decode ($response));