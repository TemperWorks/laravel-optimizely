<?php namespace TemperWorks\LaravelOptimizely;

use Cache;
use Optimizely\Optimizely;
use TemperWorks\Event\Dispatcher\QueuedEventDispatcher;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laravel-optimizely.php' => config_path('laravel-optimizely.php'),
        ]);

        $this->mergeConfigFrom(__DIR__.'/../config/laravel-optimizely.php', 'laravel-optimizely');
        $this->loadRoutesFrom(__DIR__.'/../routes.php');

        $this->app->bind('laravel-optimizely', function($app)
        {
            return new Optimizely(Cache::get("optimizelyDatafile"), $app->make(QueuedEventDispatcher::class));
        });
    }
}
