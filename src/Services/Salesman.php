<?php

namespace App\Services;

use App\Repositories\Salesman as SalesmanRepository;

class Salesman implements ServiceProtocol
{
    private $repository;
    protected $searchable = [
        'name',
        'email',
        'phone'
    ];

    function __construct()
    {
        $this->repository = new SalesmanRepository();
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
        $salesman = $this->repository->create($resource);

        return $salesman;
    }

    public function update(int $id, array $data): array
    {
        $salesman = $this->repository->update($id, $data);
        return $salesman;
    }

    public function find(int $id): array
    {
        $salesman = $this->repository->find($id);
        return $salesman;
    }

}
