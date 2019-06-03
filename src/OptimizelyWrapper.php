<?php namespace TemperWorks\LaravelOptimizely;

use Cache;
use DateInterval;
use Optimizely\Optimizely;
use TemperWorks\LaravelOptimizely\Event\Dispatcher\QueuedEventDispatcher;

class OptimizelyWrapper
{
    private $datafile;

    public function __construct(Datafile $datafile)
    {
        $this->datafile = $datafile;
    }

    private function optimizely()
    {
        return app()->make(Optimizely::class, ['datafile' => $this->datafile->get(), 'eventDispatcher' => app()->make(QueuedEventDispatcher::class)]);
    }

    public function getVariant(string $experiment, string $userID)
    {
        $cacheKey = md5($this->datafile->get()) . $experiment . $userID;

        if (!Cache::has($cacheKey))
        {
            $variant = $this->optimizely()->activate($experiment, $userID);
            Cache::put($cacheKey, $variant, new DateInterval("P1D"));
        }

        return $variant ?? Cache::get($cacheKey);
    }


}
