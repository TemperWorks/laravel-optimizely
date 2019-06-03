<?php namespace TemperWorks\LaravelOptimizely\Jobs;

use Optimizely;

class LoadDataFile
{
    public $url;

    public function handle()
    {
        Optimizely::cacheDataFile();
    }
}
