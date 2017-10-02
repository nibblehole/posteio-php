<?php

namespace TorMorten\Posteio\Services\Posteio;

use Illuminate\Support\Facades\Facade;

class Posteio extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Client::class;
    }
}
