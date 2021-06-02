<?php

namespace anhnguyenbk\PHPLivestream;

interface PHPLivestream {

  /**
   * Start Livestream with object data {"topic":"Example livestream topic","startTime":"2021-01-30T20:30:00","duration":"30", "password":"123456"}
   * Duration data is in minutes.
   */
  public function createLivestream ($eventData);
}
?> 