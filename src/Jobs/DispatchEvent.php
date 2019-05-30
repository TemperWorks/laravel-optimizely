<?php namespace TemperWorks\LaravelOptimizely\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Optimizely\Event\Dispatcher\DefaultEventDispatcher;
use Optimizely\Event\LogEvent;

class DispatchEvent implements ShouldQueue
{
    public $event;

    public function __construct(LogEvent $event)
    {
        $this->event = $event;
    }

    public function handle()
    {
        (new DefaultEventDispatcher())->dispatchEvent($this->event);
    }
}
