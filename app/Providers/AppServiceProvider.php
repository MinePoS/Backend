<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Observers\QueueObserver;
use \App\QueuedCommand;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        QueuedCommand::observe(QueueObserver::class);
    }

    /**
     * Listen to the QueuedCommand deleting event.
     *
     * @param  \App\QueuedCommand  $command
     * @return void
     */
    public function deleting(QueuedCommand $command)
    {
        app('log')->info($command);
    }
}
