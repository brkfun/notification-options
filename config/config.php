<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'defaultValue'          => 1,
    'model'                 => BRKFun\NotificationOptions\Models\NotificationOption::class,
    'controllerPath'        => 'BRKFun\NotificationOptions\Controllers\NotificationController@destroy',
    'successfulPageBlade'   => 'notification-options::successful',
    'unsuccessfulPageBlade' => 'notification-options::unsuccessful',
];
