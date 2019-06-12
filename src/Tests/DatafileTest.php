<?php

namespace TemperWorks\LaravelOptimizely\Tests;

use Cache;
use Mockery;
use TemperWorks\LaravelOptimizely\Datafile;
use TemperWorks\LaravelOptimizely\DataFileCdnLoader;

class DatafileTest extends \BrowserKitTest
{
    public function test_it_gets_from_cache_if_present()
    {
        $json = json_encode(['validJson' => true]);
        $datafileLoader = Mockery::mock(DataFileCdnLoader::class);
        $datafileLoader->shouldReceive("get")->once()->andReturn($json);

        $this->app->instance(DataFileCdnLoader::class, $datafileLoader);

        Cache::shouldReceive("has")->once()->andReturn(false);
        Cache::shouldReceive("forever")->withArgs([Datafile::CACHEKEY, $json])->once();

        $datafile = $this->app->make(Datafile::class);
        $this->assertEquals($json, $datafile->get());
    }

    public function test_it_gets_the_file_if_cache_is_empty()
    {
        $json = json_encode(['validJson' => true]);
        $datafileLoader = Mockery::mock(DataFileCdnLoader::class);
        $datafileLoader->shouldReceive("get")->never();

        $this->app->instance(DataFileCdnLoader::class, $datafileLoader);

        Cache::shouldReceive("has")->once()->andReturn(true);
        Cache::shouldReceive("get")->once()->andReturn($json);

        $datafile = $this->app->make(Datafile::class);
        $this->assertEquals($json, $datafile->get());
    }
}
