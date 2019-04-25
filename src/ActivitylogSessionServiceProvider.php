<?php

namespace gpibarra\ActivitylogSession;

use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\ActivitylogServiceProvider;
use Spatie\Activitylog\ActivityLogger;

class ActivitylogSessionServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(ActivitylogServiceProvider::class);
        $this->app->bind(ActivityLogger::class, ActivityLoggerSession::class);
    }
}
