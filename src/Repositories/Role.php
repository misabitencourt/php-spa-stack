<?php

namespace App\Repositories;

use App\Models\Role as RoleModel;
use App\Models\Permission as PermissionModel;

class Role extends BaseRepository
{
    protected $searchable = [
        'name',
    ];

    function __construct()
    {
        $model = new RoleModel;
        parent::__construct($model);
    }

    public function hasUsers(int $role): bool
    {
        return $this->model->find($role)->users()->count() > 0;
    }
}
