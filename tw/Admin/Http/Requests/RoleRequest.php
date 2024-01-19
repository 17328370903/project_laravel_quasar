<?php

namespace Tw\Admin\Http\Requests;

use Illuminate\Validation\Rule;
use Tw\Models\Role;

class RoleRequest extends BaseRequest
{

    function rules()
    {
        return [
            'name'   => ['required', 'max:30'],
            'status' => ['required', Rule::in(Role::STATUS)],
            'routes' => ['required', 'array'],
        ];
    }

    function attributes()
    {
        return [
            'name'   => trans('common.role-name'),
            'routes' => trans('common.routes-auth')
        ];
    }

}
