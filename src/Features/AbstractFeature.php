<?php

namespace  TemperWorks\LaravelOptimizely\Features;


use TemperWorks\LaravelOptimizely\Contracts\AudienceContract;
use TemperWorks\LaravelOptimizely\Contracts\FeatureContract;
use TemperWorks\LaravelOptimizely\OptimizelyWrapper;

abstract class AbstractFeature implements FeatureContract
{
    public function getParams() : array
    {
        $params = $this->getAttributes();
        $audiences = collect($this->getAudiences())
            ->map(function (AudienceContract $audience) {
                return $audience->getAttributes();
            });


        return $audiences->collapse()->merge($params)->toArray();
    }

    public function getAttributes() : array
    {
        return [
            //
        ];
    }

    public function getAudiences() : array
    {
        return [
            //
        ];
    }

    public static function isEnabled()
    {
        return app()->make(OptimizelyWrapper::class)->isFeatureEnabled(new static(...func_get_args()));
    }
}
