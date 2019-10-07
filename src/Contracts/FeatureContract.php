<?php

namespace TemperWorks\LaravelOptimizely\Contracts;

interface FeatureContract
{
    public function getExperiment() : string;

    public function getIdentifier() : string;

    public function getAttributes() : array;

    public function getAudiences() : array;

    public function getParams() : array;
}
