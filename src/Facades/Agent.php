<?php

namespace Yuniorhernandez\Agent\Facades;

use Illuminate\Support\Facades\Facade;

class Agent extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'agent';
    }
}