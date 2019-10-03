<?php

namespace BRKFun\NotificationOptions\Controllers;

use BRKFun\NotificationOptions\Exceptions\NotificationNotFoundException;
use BRKFun\NotificationOptions\Models\NotificationOption;
use BRKFun\NotificationOptions\Requests\NotificationRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class NotificationController extends Controller
{
    private $notificationName;
    private $email;
    private $token;

    public function store(NotificationRequest $request)
    {
        $this->setAttributes($request);
        try {
            $notificationOption        = $this->controlAttributes();
            $notificationOption->value = 1;
            $notificationOption->token = tokenSetter();
            $notificationOption->save();
        } catch (NotificationNotFoundException $exception) {
            return $this->failureResponse($exception);
        }
        return $this->successResponse();
    }

    /**
     * @param NotificationRequest $request
     * @return Factory|View
     */
    public function destroy(NotificationRequest $request)
    {
        $this->setAttributes($request);
        try {
            $notificationOption        = $this->controlAttributes();
            $notificationOption->value = 0;
            $notificationOption->token = tokenSetter();
            $notificationOption->save();
        } catch (NotificationNotFoundException $exception) {
            return $this->failureResponse($exception);
        }
        return $this->successResponse();
    }

    protected function successResponse()
    {
        return view(config('notification-options.successfulPageBlade'));
    }

    protected function failureResponse(NotificationNotFoundException $exception)
    {
        return view(config('notification-options.unsuccessfulPageBlade'), ['message' => $exception->getMessage()]);
    }

    /**
     * @return Builder|Model|object|null
     * @throws NotificationNotFoundException
     */
    protected function controlAttributes()
    {
        $notificationOption = NotificationOption::query()->where('key', $this->notificationName)->first();
        if (!$notificationOption) {
            throw new NotificationNotFoundException();
        }
        if ($notificationOption->notifiable->email !== $this->email || $notificationOption->token !== $this->token) {
            throw new NotificationNotFoundException('Your data is wrong');
        }
        return $notificationOption;
    }

    protected function setAttributes(Request $request)
    {
        $this->token            = $request->get('token');
        $this->email            = $request->get('email');
        $this->notificationName = $request->get('notification_name');
    }
}
