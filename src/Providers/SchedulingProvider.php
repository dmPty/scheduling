<?php

namespace ElementVip\Scheduling\Providers;

use ElementVip\Scheduling\Schedule\ScheduleHandle;
use ElementVip\Scheduling\Schedule\ScheduleList;
use Illuminate\Support\ServiceProvider;

class SchedulingProvider extends ServiceProvider
{

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->app->make('ElementVip\Scheduling\Schedule\ScheduleHandle');
        }
    }

    public function register()
    {
        $this->app->singleton('ElementVip\Scheduling\Schedule\ScheduleHandle', function ($app) {
            return new ScheduleHandle($app);
        });

        $this->app->singleton('ElementVip\ScheduleList', function () {
            return new ScheduleList();
        });
    }

}
