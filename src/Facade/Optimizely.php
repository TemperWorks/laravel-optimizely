<?php namespace TemperWorks\LaravelOptimizely\Facade;

use Illuminate\Support\Facades\Facade;

class Optimizely extends Facade
{
    protected static function getFacadeAccessor() { return 'laravel-optimizely'; }
}
