<?php

namespace Tw\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Route extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'title', 'path', 'active_path', 'icon', 'pid', 'is_hidden', 'api', 'method',
    ];

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'pid', 'id')->with(['children']);
    }


}
