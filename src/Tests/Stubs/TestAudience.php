<?php

namespace TemperWorks\LaravelOptimizely\Tests\Stubs;

use TemperWorks\LaravelOptimizely\Contracts\AudienceContract;

class TestAudience implements AudienceContract{

    protected $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getAttributes() : array
    {
        return [
            'is_even' => $this->id % 2 === 0
        ];
    }
}
