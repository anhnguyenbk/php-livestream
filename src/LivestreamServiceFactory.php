<?php

namespace anhnguyenbk\PHPLivestream;

class LivestreamServiceFactory {
    function createZoomService ($apiKey, $apiSecret) {
        return new ZoomLivestream($apiKey, $apiSecret);
    }
}