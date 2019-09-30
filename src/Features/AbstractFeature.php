<?php

namespace  TemperWorks\LaravelOptimizely\Features;


use TemperWorks\LaravelOptimizely\OptimizelyWrapper;

abstract class AbstractFeature
{
    public function getParams() : array
    {
        $params = $this->getAttributes();
        $audiences = collect($this->getAudiences())->map(function ($audience) {
            return (new $audience($this))->getAttributes();
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
