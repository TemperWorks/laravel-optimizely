<?php

namespace TemperWorks\LaravelOptimizely\Tests\Stubs;

use TemperWorks\LaravelOptimizely\Contracts\FeatureContract;
use TemperWorks\LaravelOptimizely\Features\AbstractFeature;

class TestFeature extends AbstractFeature implements FeatureContract {

    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getExperiment() : string
    {
        return 'test_experiment';
    }

    public function getIdentifier() : string
    {
        return $this->id;
    }

    public function getAttributes() : array
    {
        return [
            'foo' => 'bar'
        ];
    }
}
