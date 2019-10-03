<?php

namespace BRKFun\NotificationOptions\Requests;

use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidatesWhenResolvedTrait;

class NotificationRequest extends Request implements ValidatesWhenResolved
{
    use ValidatesWhenResolvedTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'email'             => 'required|string',
            'token'             => 'required',
            'notification_name' => 'required',
        ];
    }
}
