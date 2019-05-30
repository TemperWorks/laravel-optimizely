<?php namespace TemperWorks\LaravelOptimizely\Jobs;

use Storage;

class LoadDataFile
{
    public $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function handle()
    {
        Storage::disk(config('laravel-optimizely.datafile_disk'))->put("optimizely_datafile.json", file_get_contents($url));
    }
}
