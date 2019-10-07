<?php

namespace  TemperWorks\LaravelOptimizely\Features;


use TemperWorks\LaravelOptimizely\Contracts\AudienceContract;
use TemperWorks\LaravelOptimizely\Contracts\FeatureContract;

abstract class AbstractFeature implements FeatureContract
{
    final public function getParams() : array
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
            // new TestAudience(),
        ];
    }

    public static function isEnabled()
    {
        return app()->make('laravel-optimizely')->isFeatureEnabled(new static(...func_get_args()));
    }

    public static function activate()
    {
        return app()->make('laravel-optimizely')->activate(new static(...func_get_args()));
    }
}
