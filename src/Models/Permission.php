<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'role_id',
        'resource_id',
        'create',
        'read',
        'update',
        'delete',
    ];

    public function resources()
    {
        return $this->hasMany('App\Models\Resource', 'id', 'resource_id');
    }
}
