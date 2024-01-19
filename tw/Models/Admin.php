<?php

namespace Tw\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Hash;

class Admin extends BaseModel
{

    public const  STATUS = [
        'stop'   => 1, //停用
        'normal' => 0 //正常
    ];

    public const IS_SUPER = [
        'super'  => 1, //超级管理员
        'normal' => 0 //普通管理员
    ];

    protected $fillable = ['last_login_time', 'name', 'password', 'email', 'status', 'last_login_ip'];
    protected $hidden = ['password'];


    public function password(): Attribute
    {
        return Attribute::set(function ($pwd) {
            return Hash::make($pwd);
        });
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'admin_role_rel', 'admin_id', 'role_id');
    }

}
