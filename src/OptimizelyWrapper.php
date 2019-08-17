<?php namespace TemperWorks\LaravelOptimizely;

use Cache;
use Optimizely\Optimizely;

class OptimizelyWrapper
{
    private $datafile;
    private $optimizely;

    public function isFeatureEnabled(string $experiment, string $userID, $params = []) : bool
    {
        $this->datafile = app()->make(Datafile::class)->get();
        $this->optimizely = app()->make(Optimizely::class);

        $cacheKey = 'isFeatureEnabled-' . $experiment . $userID . md5(json_encode($params)) . md5($this->datafile);

        if (!Cache::has($cacheKey))
        {
            $variant = $this->optimizely->isFeatureEnabled($experiment, $userID, $params);

            Cache::forever($cacheKey, $variant);
        }

        return $variant ?? Cache::get($cacheKey);
    }

    public function track($event, $userID, $params = [])
    {
        $this->optimizely = app()->make(Optimizely::class);
        return $this->optimizely->track($event, $userID, $params);
    }

}
