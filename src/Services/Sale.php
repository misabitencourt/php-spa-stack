<?php

namespace App\Services;

use App\Repositories\Sale as SaleRepository;
use App\Repositories\Customer as CustomerRepository;

class Sale implements ServiceProtocol
{
    private $repository;
    private $customerRepository;
    protected $searchable = [];

    function __construct()
    {
        $this->repository = new SaleRepository();
        $this->customerRepository = new CustomerRepository();
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
        if (empty($resource['items'])) {
            throw new \Exception('Nenhum item selecionado');
        }
        if (empty($resource['salesmen'])) {
            throw new \Exception('Nenhum vendedor selecionado');
        }
        if (isset($resource['customer_name'])) {
            $customer = $this->customerRepository->create([
                'name' => $resource['customer_name']
            ]);

            $resource['customers'] = $customer;
        } else if (empty($resource['customers']))  {
            throw new \Exception('Nenhum cliente selecionado');
        }

        $sales = $this->repository->create([
            'customer_id' => $resource['customers']['id'],
            'salesman_id' => $resource['salesmen']['id'],
            'items' => $resource['items'],
            'obs' => empty($resource['obs']) ? '' : $resource['obs'],
        ]);

        return $sales;
    }

    public function update(int $id, array $data): array
    {
        $sales = $this->repository->update($id, $data);
        return $sales;
    }

    public function find(int $id): array
    {
        $sales = $this->repository->find($id);
        return $sales;
    }

}
