<?php namespace TemperWorks\LaravelOptimizely\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use TemperWorks\LaravelOptimizely\OptimizelyWrapper;

class TrackEvent implements ShouldQueue
{
    public $event;
    public $user;

    public function __construct($event, $user)
    {
        $this->event = $event;
        $this->user = $user;
    }

    public function handle()
    {
        app()->make(OptimizelyWrapper::class)->track($event, $user);
    }
}
