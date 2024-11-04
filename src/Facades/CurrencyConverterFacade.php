<?php

namespace Hutchh\CurrencyConverter\Facades;

use Illuminate\Support\Facades\Facade;

class CurrencyConverterFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'currency.handler';
    }
}