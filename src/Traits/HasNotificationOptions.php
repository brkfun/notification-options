<?php


namespace BRKFun\NotificationOptions\Traits;

use BRKFun\NotificationOptions\Models\NotificationOption;

trait HasNotificationOptions
{
    public $token;

    public function setToken()
    {
        $this->token = tokenSetter();
    }

    public function initializeHasNotificationOptions()
    {
        $this->setToken();
        $this->with[] = 'notificationOptions';
    }

    public function saveNotificationOptions($key, $value)
    {
        $this
            ->notificationOptions()
            ->updateOrCreate(
                [
                    'key' => $key,
                ],
                [
                    'value' => $value,
                    'token' => $this->token,
                ]
            );
    }

    public function setNotificationOption($key)
    {
        $this
            ->notificationOptions()
            ->create(
                [
                    'key'   => $key,
                    'value' => config('notification-option.defaultValue', 1),
                    'token' => $this->token,
                ]
            );
        $this->load('notificationOptions');
    }

    public function notificationOptions()
    {
        return $this->morphMany(config('notification-option.model', NotificationOption::class), 'notifiable');
    }

    public function __get($key)
    {
        if (substr($key, 0, 5) === 'wants') {
            $wantWhat = lcfirst(substr($key, 5));
            $data     = $this->notificationOptions->where('key', $wantWhat)->first();
            if ($data) {
                return $data->value;
            }
            $this->setNotificationOption($wantWhat);
            return $this->notificationOptions->where('key', $wantWhat)->first()->value;
        }

        return parent::__get($key);
    }

    public function __set($name, $value)
    {
        if (substr($name, 0, 5) === 'wants') {
            $setName = lcfirst(substr($name, 5));
            $this->saveNotificationOptions($setName, $value);
            unset($this->$name);
            return $this;
        }

        return parent::__set($name, $value);
    }
}
