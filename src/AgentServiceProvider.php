<?php

namespace Yuniorhernandez\Agent;

use Illuminate\Support\ServiceProvider;

class AgentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->singleton('agent', function () {
            return new Agent;
        });
    }
}
