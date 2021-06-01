<?php

namespace anhnguyenbk\PHPLivestream;

use Illuminate\Support\ServiceProvider;

class LivestreamServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // echo __DIR__.'\database\migrations\create_randomables_table.php';
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }
}
