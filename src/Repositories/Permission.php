<?php

namespace App\Repositories;

use App\Models\Permission as PermissionModel;
use App\Models\Resource as ResourceModel;
use App\Helpers\Session;

class Permission extends BaseRepository
{
    function __construct()
    {
        $model = new PermissionModel();
        parent::__construct($model);
    }

    public function listByCurrentUser(): array
    {
        $session = new Session();
        $role =  $session->get('user.role');

        $permissions = $this->model
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->where('role_id', $role);

        return array_map(function ($permission) {
            return [
                'read' => $permission['read'],
                'update' => $permission['update'],
                'delete' => $permission['delete'],
                'create' => $permission['create'],
                'resource' => ResourceModel::find($permission['resource_id'])->name
            ];
        }, $permissions->get()->toArray());
    }

    public function listByRole(int $role): array
    {
        $permissions = $this->model->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->where('role_id', $role)
            ->get();

        if (!$permissions) {
            throw new NotFoundException();
        }

        return $permissions->toArray();
    }

    public function destroyByRole(int $role)
    {
        $permissions = $this->model->where('role_id', $role)->get();

        foreach ($permissions as $permission) {
            $permission->delete();
        }
    }
}
