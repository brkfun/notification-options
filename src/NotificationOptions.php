<?php

namespace BRKFun\NotificationOptions;

use BRKFun\NotificationOptions\Exceptions\NotificationNotFoundException;
use BRKFun\NotificationOptions\Models\NotificationOption;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class NotificationOptions
{
    /**
     * @var Model
     */
    private $model;

    /**
     * @var string
     */
    private $name;

    public function setModel(Model $model)
    {
        $this->model = $model;
        return $this;
    }

    public function setName(string $notificationName)
    {
        $this->name = $notificationName;
        return $this;
    }

    /**
     * @param bool $value
     * @return Builder|Model|object|null
     * @throws NotificationNotFoundException
     */
    public function setNotification(bool $value)
    {
        $notification = $this->notificationQuery();
        if(!$notification){
            throw new NotificationNotFoundException();
        }
        $notification->value = $value;
        $notification->token = tokenSetter();
        $notification->save();
        return $notification;
    }

    public function makeLink(Model $model, NotificationOption $notificationOption)
    {
        return route('notification-options::unsubscribe',
                     [
                         'email'             => $model->email,
                         'remember_token'    => $notificationOption->token,
                         'notification_name' => $notificationOption->key,
                     ]
        );
    }

    protected function notificationQuery()
    {
        $notificationOption = NotificationOption::query()
            ->where('key', $this->name)
            ->where('notifiable_type', $this->model->getMorphClass())
            ->where('notifiable_id', $this->model->id)
            ->first();
        return $notificationOption;
    }
}
