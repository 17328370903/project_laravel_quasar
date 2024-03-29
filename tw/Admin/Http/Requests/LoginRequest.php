<?php

namespace Tw\Admin\Http\Requests;


class LoginRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            "email"    => ['required', 'email'],
            'password' => ['required']
        ];
    }
}
