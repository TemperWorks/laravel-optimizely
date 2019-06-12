<?php namespace TemperWorks\LaravelOptimizely;

use Cache;

class Datafile
{
    const CACHEKEY = 'optimizelyDatafile';

    public function get($overrideCache = false)
    {
        if ($overrideCache || !Cache::has(self::CACHEKEY))
        {
            $fileContent = app()->make(DataFileCdnLoader::class)->get();

            Cache::forever(self::CACHEKEY, $fileContent);
        }

        return $fileContent ?? Cache::get(self::CACHEKEY);
    }

}
