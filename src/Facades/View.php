<?php

namespace NF\Mail\Facades;

use Illuminate\Support\Facades\Facade;

class View extends Facade
{
    protected static function getFacadeAccessor()
    {
        return new \NF\Mail\Services\View;
    }
}
