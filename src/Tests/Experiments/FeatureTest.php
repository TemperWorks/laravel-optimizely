<?php

namespace TemperWorks\LaravelOptimizely\Tests\Experiments;

use TemperWorks\LaravelOptimizely\OptimizelyWrapper;
use TemperWorks\LaravelOptimizely\Tests\Stubs\TestAudience;
use TemperWorks\LaravelOptimizely\Tests\Stubs\TestFeature;

class FeatureTest extends \BrowserKitTest
{

    public function test_it_passes_correct_data()
    {
        $feature = new TestFeature(2);

        $this->assertEquals('text_experiment', $feature->getExperiment());
        $this->assertEquals(2, $feature->getIdentifier());
        $this->assertEquals([TestAudience::class], $feature->getAudiences());
        $this->assertEquals(['foo' => 'bar'], $feature->getAttributes());
    }

    public function test_it_merges_data_correctly()
    {
        $feature = new TestFeature(1);

        $this->assertEquals([
            'is_odd' => true,
            'foo' => 'bar',
        ], $feature->getParams());

        $feature = new TestFeature(2);

        $this->assertEquals([
            'is_odd' => true,
            'foo' => 'bar',
        ], $feature->getParams());
    }

    public function test_isEnabled_should_call_optimizely()
    {
        $mock = \Mockery::mock(OptimizelyWrapper::class);
        $mock->shouldReceive('isFeatureEnabled')->with(
            new TestFeature(2)
        );

        $this->app->instance(OptimizelyWrapper::class, $mock);

        TestFeature::isEnabled(2);
    }
}
