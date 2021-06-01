<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use anhnguyenbk\PHPLivestream\LivestreamServiceFactory;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/createLiveStream', function () {
    $livestreamServiceFactory = new LivestreamServiceFactory();

    $apiKey = 'b0kkpfcpSxqX-p9T-2nNVQ';
    $apiSecret = 'vW2vMphcJ2eDHjJAPkCbScJnJpjvKtvEil3x';

    $zoomService = $livestreamServiceFactory->createZoomService ($apiKey, $apiSecret);

    $livestream = new \stdClass();
    $livestream->topic = "Example livestream topic";
    $livestream->startTime = "2021-05-31T20:30:00";
    $livestream->duration = "60";
    $livestream->password = "111111";

    $userId= 1;
    $classId = 5;
    $response = $zoomService->createLivestream($userId, $classId, $livestream);
    return $response->toJson();
});

