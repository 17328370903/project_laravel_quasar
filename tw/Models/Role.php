<?php

namespace Tw\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends BaseModel
{
    protected $fillable = ['name', 'status'];

    public const  STATUS = [
        'stop'   => 1, //停用
        'normal' => 0 //正常
    ];


    public function routes(): BelongsToMany
    {
        return $this->belongsToMany(Route::class, 'role_route_rel', 'role_id', 'route_id');
    }
}
