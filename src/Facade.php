<?php namespace TemperWorks\LaravelOptimizely\Facade;

use Illuminate\Support\Facades\Facade as BaseFacade;

class Facade extends BaseFacade
{
    protected static function getFacadeAccessor() { return 'laravel-optimizely'; }
}
