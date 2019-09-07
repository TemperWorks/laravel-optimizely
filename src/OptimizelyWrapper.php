<?php namespace TemperWorks\LaravelOptimizely;

use Cache;
use Optimizely\Optimizely;

class OptimizelyWrapper
{
    const TYPE_IS_FEATURE_ENABLED = "isFeatureEnabled";
    const TYPE_ACTIVATE = "activate";

    private $datafile;
    private $optimizely;

    public function isFeatureEnabled(string $experiment, string $userID, $params = []) : bool
    {
        return $this->cacheOptimizelyResponse($experiment, $userID, $params, self::TYPE_IS_FEATURE_ENABLED);
    }

    public function activate(string $experiment, string $userID, $params = []) : string
    {
        return $this->cacheOptimizelyResponse($experiment, $userID, $params, self::TYPE_ACTIVATE);
    }

    public function track($event, $userID, $params = [])
    {
        $this->optimizely = app()->make(Optimizely::class);
        return $this->optimizely->track($event, $userID, $params);
    }

    /**
     * @return Optimizely\Optimizely
     * In case for some reason we want to access the optimizely instance directly.
     */
    public function getOptimizelyInstance()
    {
        $this->optimizely = app()->make(Optimizely::class);
        return $this->optimizely();
    }

    private function cacheOptimizelyResponse($experiment, $userID, $params, $type) {
        $this->datafile = app()->make(Datafile::class)->get();
        $this->optimizely = app()->make(Optimizely::class);

        $cacheKey = $type . '-' . $experiment . $userID . md5(json_encode($params)) . md5($this->datafile);

        if (!Cache::has($cacheKey))
        {
            $variant = $this->optimizely->$type($experiment, $userID, $params);
            Cache::forever($cacheKey, $variant);
        }

        return $variant ?? Cache::get($cacheKey);
    }

}
