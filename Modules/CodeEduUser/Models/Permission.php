<?php

namespace CodeEduUser\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'description',
        'resource_name',
        'resource_description'
    ];

    public function roles() {
        return $this->belongsToMany(Role::class);
    }
}
