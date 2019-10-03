<?php

namespace TemperWorks\LaravelOptimizely\Tests\Stubs;

use TemperWorks\LaravelOptimizely\Features\AbstractFeature;

class TestFeature extends AbstractFeature {

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
        return (string) $this->id;
    }

    public function getAttributes() : array
    {
        return [
            'foo' => 'bar'
        ];
    }

    public function getAudiences() : array
    {
        return [
            new TestAudience($this->id)
        ];
    }
}
