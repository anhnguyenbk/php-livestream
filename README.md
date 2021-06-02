# Laravel Live Event
Laravel package for managing livestream events with the associated streaming platform. Currently the package only supports [Zoom](https://zoom.us/) platform.

## Installation
### 1. Via Private Packagist

### 2. Via github

## Structure
### Database migrations
```
database\migrations\create_live_event_table
database\migrations\create_register_event_table
```
### Model
```
Model\LiveEvent
Model\RegisterEvent
```

## Usages
### With Zoom platform (currently supports)

1. Create your Zoom JWT application `https://marketplace.zoom.us/docs/guides/build/jwt-app`. Store your apiKey and apiSecret, the package will use that later for authentication.
2. Run `php artisan migrate` to generate package's tables (`live_events` and `register_event` table).

3. Create an livestream event example in `routes\web.php`
    ```
    use anhnguyenbk\PHPLivestream\LivestreamServiceFactory;
    ```
    ```
    Route::get('/createLiveStream', function () {
        $livestreamServiceFactory = new LivestreamServiceFactory();
        $apiKey = 'your-api-key';
        $apiSecret = 'your-api-sercret';

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
    ```
    If the process is successful, a new record with be added to the `live_events` table.
