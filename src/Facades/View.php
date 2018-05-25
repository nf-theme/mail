<?php

namespace Vicoders\Mail\Facades;

use Illuminate\Support\Facades\Facade;

class View extends Facade
{
    protected static function getFacadeAccessor()
    {
        return new \Vicoders\Mail\Services\View;
    }
}
