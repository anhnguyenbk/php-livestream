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

    function createLivestream ($userId, $classId, $eventData) {
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

        $liveEvent = new LiveEvent;
        $liveEvent->user_id = $userId;
        $liveEvent->class_id = $classId;
        $liveEvent->event_uuid = $resBody->uuid;
        $liveEvent->event_id = $resBody->id;
        $liveEvent->topic = $resBody->topic;
        $liveEvent->status = $resBody->status;
        $liveEvent->duration = $resBody->duration;
        $liveEvent->timezone = $resBody->timezone;
        $liveEvent->start_time = Carbon::now();
        $liveEvent->start_url = $resBody->start_url;
        $liveEvent->join_url = $resBody->join_url;
        $liveEvent->event_response = $response->getBody();
        $liveEvent->save();
        return $liveEvent;
    }
}
?> 