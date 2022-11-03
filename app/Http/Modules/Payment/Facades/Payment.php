<?php

namespace App\Modules\Payment\Facades;
use Illuminate\Support\Facades\Facade;

class Payment extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor():string
    {
        return 'payment';
    }
}