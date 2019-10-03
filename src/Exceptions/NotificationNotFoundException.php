<?php


namespace BRKFun\NotificationOptions\Exceptions;

use Exception;

class NotificationNotFoundException extends Exception
{
    /**
     * The message of the exception.
     *
     * @var int
     */
    protected $message = "The notification type doesn't exist.";

    /**
     * The http status code of the exception.
     *
     * @var int
     */
    protected $code = 404;
}
