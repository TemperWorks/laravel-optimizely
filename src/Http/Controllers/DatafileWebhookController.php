<?php namespace TemperWorks\LaravelOptimizely\Http\Controllers;

use Illuminate\Http\Request;
use TemperWorks\LaravelOptimizely\Jobs\LoadDataFile;

class DatafileWebhookController
{
    public function post(Request $request)
    {
        dispatch(new LoadDataFile($request->get('data.origin_url')));
    }
}
