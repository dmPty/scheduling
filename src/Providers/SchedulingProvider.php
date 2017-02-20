<?php

namespace dmpty\Scheduling\Providers;

use dmpty\Scheduling\Schedule\ScheduleHandle;
use dmpty\Scheduling\Schedule\ScheduleList;
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
            $this->app->make('dmpty\Scheduling\Schedule\ScheduleHandle');
        }
    }

    public function register()
    {
        $this->app->singleton('dmpty\Scheduling\Schedule\ScheduleHandle', function ($app) {
            return new ScheduleHandle($app);
        });

        $this->app->singleton('dmpty\ScheduleList', function () {
            return new ScheduleList();
        });
    }

}
