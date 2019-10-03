<?php


namespace BRKFun\NotificationOptions;


use Illuminate\Support\Facades\Facade;

class Subscribe extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'notification-options';
    }
}
