<?php namespace TemperWorks\LaravelOptimizely;

use Optimizely\Optimizely;
use TemperWorks\LaravelOptimizely\Event\Dispatcher\QueuedEventDispatcher;

class LaravelOptimizelyServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->app->bind('laravel-optimizely', function(){
            return app()->make(OptimizelyWrapper::class, [app()->make(Datafile::class)]);
        });

        $this->app->bind(Optimizely::class, function() {
            return new Optimizely(app()->make(Datafile::class)->get(), app()->make(QueuedEventDispatcher::class));
        });
    }
}
