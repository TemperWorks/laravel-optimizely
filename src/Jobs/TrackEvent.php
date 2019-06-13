<?php namespace TemperWorks\LaravelOptimizely\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Optimizely;

class TrackEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $event;
    protected $userID;
    protected $params;

    const APPLIED_TO_SHIFTS = "applied to shifts";

    public function __construct($event, $userID, $params=[])
    {
        $this->event = $event;
        $this->userID = $userID;
        $this->params = $params;
    }

    public function handle()
    {
        Optimizely::track($this->event, $this->userID, $this->params);
    }
}
