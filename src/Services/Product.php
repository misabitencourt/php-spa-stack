<?php

namespace App\Services;

use App\Repositories\Product as ProductRepository;

class Product implements ServiceProtocol
{
    private $repository;
    protected $searchable = [
        'name',
        'description',
    ];

    function __construct()
    {
        $this->repository = new ProductRepository();
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
        $product = $this->repository->create($resource);

        return $product;
    }

    public function update(int $id, array $data): array
    {
        $product = $this->repository->update($id, $data);
        return $product;
    }

    public function find(int $id): array
    {
        $product = $this->repository->find($id);
        return $product;
    }

}
