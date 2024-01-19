<?php

namespace Tw\Admin\Http\Requests;

class ProjectRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name'             => ['required', 'between:1,50'],
            'description'      => ['nullable', 'between:0,1000'],
            'person_in_charge' => ['nullable', 'between:0,191'],
            'project_members'  => ['nullable', 'between:0,191'],
        ];
    }

}
