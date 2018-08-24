<?php

namespace App\Repositories;

use App\Models\Resource as ResourceModel;

class Resource
{
    private $model;

    function __construct()
    {
        $this->model = new ResourceModel;
    }

    public function list(): array
    {
        $resources = $this->model
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc');

        return $resources->get()->toArray();
    }

    public function isAuthorized($resource, $action, $role): bool
    {
        return $this->model
            ->where('name', $resource)
            ->first()
            ->permissions()
            ->where($action, true)
            ->where('role_id', $role)
            ->first() !== null;
    }
}
