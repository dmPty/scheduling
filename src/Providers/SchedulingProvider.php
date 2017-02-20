<?php

namespace dmPty\Scheduling\Providers;

use dmPty\Scheduling\Schedule\ScheduleHandle;
use dmPty\Scheduling\Schedule\ScheduleList;
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
            $this->app->make('dmPty\Scheduling\Schedule\ScheduleHandle');
        }
    }

    public function register()
    {
        $this->app->singleton('dmPty\Scheduling\Schedule\ScheduleHandle', function ($app) {
            return new ScheduleHandle($app);
        });

        $this->app->singleton('dmPty\ScheduleList', function () {
            return new ScheduleList();
        });
    }

}
