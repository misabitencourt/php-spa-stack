<?php

namespace App\Services;

use App\Repositories\Customer as CustomerRepository;

class Customer implements ServiceProtocol
{
    private $repository;
    protected $searchable = [
        'name',
    ];

    function __construct()
    {
        $this->repository = new CustomerRepository();
    }

    public function list($search): array
    {
        return $this->repository->list($search);
    }

    public function destroy(int $id)
    {
        $this->repository->destroy($id);
    }

    public function create(array $resource): array
    {
        $customer = $this->repository->create($resource);

        return $customer;
    }

    public function update(int $id, array $data): array
    {
        $customer = $this->repository->update($id, $data);
        return $customer;
    }

    public function find(int $id): array
    {
        $customer = $this->repository->find($id);
        return $customer;
    }

}
