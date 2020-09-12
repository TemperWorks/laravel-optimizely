<?php

namespace TemperWorks\LaravelOptimizely\Tests;

use Cache;
use Mockery;
use Optimizely\Optimizely;
use TemperWorks\LaravelOptimizely\Datafile;
use TemperWorks\LaravelOptimizely\OptimizelyWrapper;
use TemperWorks\LaravelOptimizely\Tests\Stubs\TestFeature;

class OptimizelyWrapperTest extends \BrowserKitTest
{
    public function test_isFeatureEnabled_calls_optimizely()
    {
        $optimizelyMock = Mockery::mock(Optimizely::class);
        $optimizelyMock->shouldReceive("isFeatureEnabled")->once()->andReturn(true);
        $this->app->instance(Optimizely::class, $optimizelyMock);

        $dataFile = Mockery::mock(Datafile::class);
        $dataFile->shouldReceive("get")->andReturn('[]');
        $this->app->instance(Datafile::class, $dataFile);

        Cache::shouldReceive("has")->andReturn(false);
        Cache::shouldReceive("forever");

        $this->app->make(OptimizelyWrapper::class)->isFeatureEnabled(new TestFeature(123));
    }

    public function test_isFeatureEnabled_doesnt_call_optimizely_twice()
    {
        $optimizelyMock = Mockery::mock(Optimizely::class);
        $optimizelyMock->shouldReceive("isFeatureEnabled")->never();
        $this->app->instance(Optimizely::class, $optimizelyMock);

        $dataFile = Mockery::mock(Datafile::class);
        $dataFile->shouldReceive("get")->andReturn('[]');
        $this->app->instance(Datafile::class, $dataFile);

        Cache::shouldReceive("has")->once()->andReturn(true);
        Cache::shouldReceive("get")->once()->andReturn(true);

        $this->app->make(OptimizelyWrapper::class)->isFeatureEnabled(new TestFeature(123));
    }
}
