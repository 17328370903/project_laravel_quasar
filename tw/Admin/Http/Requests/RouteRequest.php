<?php

namespace Tw\Admin\Http\Requests;

use Tw\Models\Route;

class RouteRequest extends BaseRequest
{
    function rules()
    {
        return [
            'name'        => ['required'],
            'title'       => ['required'],
            'path'        => ['nullable'],
            'component'   => ['required'],
            'pid'         => [
                'required', 'gte:0', function ($attr, $value, $fail) {
                    $exists = Route::query()->where('id', $value)->where('id', "<>", 0)->first();
                    if (!$exists) {
                        return $fail(trans('common.parent-route-not-exists'));
                    }
                }
            ],
            'weigh'       => ['nullable', 'integer'],
            'icon'        => ['nullable'],
            'active_path' => ['nullable'],
            'redirect'    => ['nullable'],
            'is_hidden'   => ['required', 'in:0,1'],
            'method'      => ['required'],
            'api'         => ['nullable'],
        ];
    }

}
