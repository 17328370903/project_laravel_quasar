<?php

namespace Tw\Admin\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    public function toArray(Request $request): array|\JsonSerializable|Arrayable
    {
        return [
            'id'              => $this->id,
            'name'            => $this->name,
            'email'           => $this->email,
            'last_login_time' => $this->last_login_time,
            'created_at'      => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at'      => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
