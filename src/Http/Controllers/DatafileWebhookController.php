<?php namespace TemperWorks\LaravelOptimizely\Http\Controllers;

use TemperWorks\LaravelOptimizely\Datafile;

class DatafileWebhookController
{
    public function post()
    {
        app()->make(Datafile::class)->get(true);
    }
}
