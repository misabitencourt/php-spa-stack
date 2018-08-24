<?php

namespace App\Services;

use App\Repositories\Permission as PermissionRepository;
use App\Repositories\Role as RoleRepository;

class Role implements ServiceProtocol
{
    private $permissionRepository;
    private $roleRepository;
    protected $searchable = [
        'name',
    ];

    function __construct()
    {
        $this->roleRepository = new RoleRepository();
        $this->permissionRepository = new PermissionRepository();
    }

    public function list($search): array
    {
        return $this->roleRepository->list($search);
    }

    public function destroy(int $id)
    {
        if ($this->roleRepository->hasUsers($id)) {
            throw new InvalidException('Grupo tem usuários cadastrados');
        }

        $this->permissionRepository->destroyByRole((int) $id);
        $this->roleRepository->destroy($id);
    }

    public function create(array $resource): array
    {
        $role = $this->roleRepository->create($resource);

        $role['permissions'] = $this->createPermissions($role['id'], $resource['permissions']);

        return $role;
    }

    public function update(int $id, array $data): array
    {
        $role = $this->roleRepository->update($id, $data);
        $role['permissions'] = $this->updatePermissions($id, $data['permissions']);
        return $role;
    }

    public function find(int $id): array
    {
        $role = $this->roleRepository->find($id);
        $role['permissions'] = $this->permissionRepository->listByRole((int) $role['id']);
        return $role;
    }

    private function updatePermissions($role, $permissions)
    {
        $this->permissionRepository->destroyByRole((int) $role);
        return $this->createPermissions($role, $permissions);
    }

    private function createPermissions($role, $data)
    {
        $permissions = array_map(function ($permission) use ($role) {
            $permission['role_id'] = $role;
            return $permission;
        }, $data);

        $result = [];

        foreach ($permissions as $permission) {
            $result[] = $this->permissionRepository->create($permission);
        }

        return $result;
    }
}
