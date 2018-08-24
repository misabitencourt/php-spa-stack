<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->hasMany('App\Models\User', 'role_id', 'id');
    }

    public function permissions()
    {
        return $this->hasMany('App\Models\Permission', 'role_id', 'id');
    }
}
