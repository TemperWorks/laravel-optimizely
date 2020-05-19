<?php

namespace TemperWorks\LaravelOptimizely\Tests\Http\Controllers;

use Mockery;

class DatafileWebhookControllerTest extends \BrowserKitTest
{
    public function test_it_gets_datafile()
    {
        $dataFile = Mockery::mock(Datafile::class);
        $dataFile->shouldReceive("get")->withArgs([true])->once();

        $this->app->instance(Datafile::class, $dataFile);

        $this->post('/optimizely/webhook');
    }
}
