<?php namespace TemperWorks\LaravelOptimizely;

class LarvelOptimizelyServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->app->bind('laravel-optimizely', function(){
            return app()->make(OptimizelyWrapper::class, [app()->make(Datafile::class)]);
        });
    }
}
