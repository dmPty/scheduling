<?php

namespace dmpty\Scheduling\Schedule;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Foundation\Application;

class ScheduleHandle
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->app->booted(function () {
            $this->defineConsoleSchedule();
        });
    }

    public function defineConsoleSchedule()
    {
        $this->app->instance(
            'Illuminate\Console\Scheduling\Schedule', $scheduling = new Schedule
        );
        $this->schedule($scheduling);
    }

    public function schedule(Schedule $schedule)
    {
        $scheduleList = $this->app->make('dmpty\ScheduleList');
        foreach ($scheduleList->get() as $class) {
            $instance = new $class($schedule);
            $instance->schedule();
        }
    }
}