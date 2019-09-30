<?php

namespace TemperWorks\LaravelOptimizely\Contracts;


interface AudienceContract
{
    public function __construct(FeatureContract $feature);

    public function getAttributes();
}
