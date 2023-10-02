<?php

namespace Sabers\ModulesManager\Facades;

use Illuminate\Support\Facades\Facade;

class ModulesManagerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'modules-manager';
    }
}
