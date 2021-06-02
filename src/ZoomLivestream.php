<?php

namespace anhnguyenbk\PHPLivestream;

use \Firebase\JWT\JWT;
use GuzzleHttp\Client;
use anhnguyenbk\PHPLivestream\Model\LiveEvent;
use Carbon\Carbon;

class ZoomLivestream implements PHPLivestream {
    function __construct($apiKey, $apiSecret) {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
    }

    private function getZoomAccessToken() {
        $payload = array(
            "iss" => $this->apiKey,
            'exp' => time() + 3600,
        );
        return JWT::encode($payload, $this->apiSecret);    
    }

    function createLivestream ($eventData) {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.zoom.us',
            'verify' => false
        ]);

        $response = $client->request('POST', '/v2/users/me/meetings', [
            "headers" => [
                "Authorization" => "Bearer " . $this->getZoomAccessToken()
            ],
            'json' => [
                "topic" => $eventData->topic,
                "type" => 2,
                "start_time" => $eventData->startTime,
                "duration" => $eventData->duration, // mins
                "password" => $eventData->password
            ],
        ]);
     
        error_log ("Zoom startLivestream response data " . $response->getBody());
        $resBody = json_decode($response->getBody());
        return $resBody;
    }
}
?> 