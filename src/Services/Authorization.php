<?php

namespace App\Services;

use App\Repositories\Resource as ResourceRepository;

class Authorization
{
    private $role;
    private $resource;
    private $resourceRepository;

    public function __construct($resource, $role)
    {
        $this->role = $role;
        $this->resource = $resource;
        $this->resourceRepository = new ResourceRepository();
    }

    public function isAuthorized($action)
    {
        try {
            return $this->resourceRepository
                ->isAuthorized($this->resource, $action, $this->role);
        } catch (Exception $e) {
            return false;
        }
    }
}
