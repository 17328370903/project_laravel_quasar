<?php

namespace Tw\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends BaseModel
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'admin_id', 'person_in_charge', 'project_members'];

    public function creator(): HasOne
    {
        return $this->hasOne(Admin::class, 'id', 'admin_id')->select(['id', 'name']);
    }

}
