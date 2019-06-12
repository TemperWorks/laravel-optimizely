<?php namespace TemperWorks\LaravelOptimizely;

use Cache;
use Optimizely\Optimizely;
use TemperWorks\LaravelOptimizely\Event\Dispatcher\QueuedEventDispatcher;

class OptimizelyWrapper
{
    private $datafile;
    private $optimizely;

    public function __construct()
    {
        $this->datafile = app()->make(Datafile::class)->get();
        $this->optimizely = app()->make(Optimizely::class);
    }

    public function isFeatureEnabled(string $experiment, string $userID, $params = []) : bool
    {
        $cacheKey = 'isFeatureEnabled-' . $experiment . $userID . md5(json_encode($params)) . md5($this->datafile);

        if (!Cache::has($cacheKey))
        {
            $variant = $this->optimizely->isFeatureEnabled($experiment, $userID, $params);

            Cache::forever($cacheKey, $variant);
        }
        else
        {
            print "from cache";
        }

        return $variant ?? Cache::get($cacheKey);
    }

    public function track($event, $userID, $params = [])
    {
        return $this->optimizely->track($event, $userID, $params);
    }

}
