<?php

namespace anhnguyenbk\PHPLivestream;

use \Firebase\JWT\JWT;
use GuzzleHttp\Client;

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

    function createLivestream ($livestream) {
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
                "topic" => $livestream->topic,
                "type" => 2,
                "start_time" => $livestream->startTime,
                "duration" => $livestream->duration, // mins
                "password" => $livestream->password
            ],
        ]);
     
        error_log ("Zoom startLivestream response data " . $response->getBody());
        return json_decode($response->getBody());
    }
}
?> 