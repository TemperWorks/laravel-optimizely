<?php namespace TemperWorks\LaravelOptimizely;

use Cache;
use Optimizely\Optimizely;
use TemperWorks\LaravelOptimizely\Contracts\FeatureContract;

class OptimizelyWrapper
{
    const TYPE_IS_FEATURE_ENABLED = "isFeatureEnabled";
    const TYPE_ACTIVATE = "activate";

    private $datafile;
    private $optimizely;

    public function isFeatureEnabled(FeatureContract $feature) : bool
    {
        return $this->cacheOptimizelyResponse(
            $feature->getExperiment(), 
            $feature->getIdentifier(), 
            $feature->getParams(), 
            self::TYPE_IS_FEATURE_ENABLED) ?? false;
    }

    public function activate(FeatureContract $feature) : ?string
    {
        return $this->cacheOptimizelyResponse(
            $feature->getExperiment(), 
            $feature->getIdentifier(), 
            $feature->getParams(), 
            self::TYPE_ACTIVATE);
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
