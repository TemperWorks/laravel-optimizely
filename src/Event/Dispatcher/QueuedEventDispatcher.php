<?php namespace TemperWorks\Event\Dispatcher;

use Optimizely\Event\Dispatcher;
use Optimizely\Event\LogEvent;
use TemperWorks\LaravelOptimizely\Jobs\DispatchEvent;

class QueuedEventDispatcher implements Dispatcher\EventDispatcherInterface
{
    public function dispatchEvent(LogEvent $event)
    {
        dispatch(new DispatchEvent($event));
    }
}
