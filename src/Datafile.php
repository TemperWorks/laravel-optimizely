<?php namespace TemperWorks\LaravelOptimizely;

use Cache;

class Datafile
{
    const CACHEKEY = 'optimizelyDatafile';

    public function get($overrideCache = false)
    {
        if ($overrideCache || !Cache::has(self::CACHEKEY))
        {
            $fileContent = file_get_contents('https://cdn.optimizely.com/datafiles/'.env('OPTIMIZELY_SDK_KEY').'.json');
            Cache::forever(self::CACHEKEY, $fileContent);
        }

        return $fileContent ?? Cache::get(self::CACHEKEY);
    }
}
