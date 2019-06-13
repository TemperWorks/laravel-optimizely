<?php namespace TemperWorks\LaravelOptimizely\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Optimizely\Event\Dispatcher\DefaultEventDispatcher;
use Optimizely\Event\LogEvent;

class DispatchEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
