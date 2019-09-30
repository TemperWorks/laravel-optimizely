<?php

namespace TemperWorks\LaravelOptimizely\Tests\Stubs;

use TemperWorks\LaravelOptimizely\Contracts\AudienceContract;
use TemperWorks\LaravelOptimizely\Contracts\FeatureContract;

class TestAudience implements AudienceContract{

    protected $feature;

    public function __construct(FeatureContract  $feature)
    {
        $this->feature = $feature;
    }

    public function getAttributes()
    {
        return [
            'is_even' => $this->feature->getIdentifier() % 2 === 0
        ];
    }
}
