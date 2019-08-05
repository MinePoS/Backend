<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class QueueModelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //\App\QueuedCommand::observe(\App\Observers\QueueObserver::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
