<?php

namespace Tw\Admin\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Tw\Models\Admin;

class AdminRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'name'     => 'required',
            'email'    => 'email|required|unique:admins,email,' . $this->id,
            'password' => 'required|confirmed|min:6|max:20',
            'status'   => ['required', Rule::in(Admin::STATUS)],
            'roles'    => ['nullable', 'array']
        ];

        $routeName = Route::currentRouteName();

        if ($routeName === "admin.update") {
            $rules['password'] = 'nullable|confirmed|min:6|max:20';
        }

        if ($routeName === "common.update-current-admin") {
            $rules['password'] = 'nullable|confirmed|min:6|max:20';
            $rules['email']    = 'email|required|unique:admins,email,' . request()->admin->id;
            unset($rules['roles']);
            unset($rules['status']);
        }


        return $rules;
    }

    public function attributes(): array
    {
        return [
            'status' => trans('common.status')
        ];
    }


}
