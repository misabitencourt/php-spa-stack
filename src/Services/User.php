<?php

namespace App\Services;

use App\Repositories\Role as RoleRepository;
use App\Repositories\User as UserRepository;

class User implements ServiceProtocol
{
    private $roleRepository;
    private $userRepository;
    protected $searchable = [
        'name',
    ];

    function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->roleRepository = new RoleRepository();
    }

    public function list($search): array
    {
        return $this->userRepository->list($search);
    }

    public function destroy(int $id)
    {
        $this->userRepository->destroy($id);
    }

    public function create(array $resource): array
    {
        $resource['role_id'] = 1; // TODO
        $user = $this->userRepository->create($resource);

        return $user;
    }

    public function update(int $id, array $data): array
    {
        $user = $this->userRepository->update($id, $data);
        return $user;
    }

    public function find(int $id): array
    {
        $user = $this->userRepository->find($id);
        return $user;
    }

}
