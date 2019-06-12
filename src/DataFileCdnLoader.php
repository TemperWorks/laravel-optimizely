<?php namespace TemperWorks\LaravelOptimizely;

class DataFileCdnLoader
{
    public function get()
    {
        return file_get_contents('https://cdn.optimizely.com/datafiles/'.env('OPTIMIZELY_SDK_KEY').'.json');
    }
}
