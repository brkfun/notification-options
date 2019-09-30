<?php

namespace BRKFun\NotificationOptions;

use Illuminate\Support\Facades\Facade;

/**
 * @see \BRKFun\NotificationOptions\Skeleton\SkeletonClass
 */
class NotificationOptionsFacade extends Facade
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
