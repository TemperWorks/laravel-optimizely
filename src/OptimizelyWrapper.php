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
        $cacheKey = 'activate' . $experiment . $userID . md5($this->datafile->get());

        if (!Cache::has($cacheKey))
        {
            $variant = $this->optimizely()->activate($experiment, $userID);
            Cache::forever($cacheKey, $variant);
        }

        return $variant ?? Cache::get($cacheKey);
    }

    public function track($event, $userID, $params = [])
    {
        return $this->optimizely()->track($event, $userID, $params);
    }

}
