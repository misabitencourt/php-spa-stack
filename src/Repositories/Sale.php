<?php

namespace App\Repositories;

use App\Models\Sale as Model;
use App\Models\SaleItem as ItemModel;
use App\Exceptions\NotFoundException;
use App\Exceptions\InvalidException;

class Sale extends BaseRepository
{
    protected $searchable = [];
    protected $itemModel;

    function __construct()
    {
        parent::__construct(new Model);
        $this->itemModel = new ItemModel();
    }

    public function list(string $search = null): array
    {
        $resource = $this->model            
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->with('customer')
            ->with('salesman');

        $search = explode('--', "$search");
        if (sizeof($search) === 2) {
            $start = new \DateTime($search[0]);
            $end = new \DateTime($search[1]);
            $resource->whereBetween('created_at', [$start, $end]);
        }

        if ($search !== null) {
            foreach ($this->searchable as $index => $field) {
                if ($index === 0) {
                    $resource->where($field, 'LIKE', '%'.$search.'%');
                    continue;
                }
                $resource->orWhere($field, 'LIKE', '%'.$search.'%');
            }
        }
        
        $today = new \DateTime('now');
        $list = $resource->limit(25)->get()->toArray();
        foreach ($list as $i => $sale) {            
            $totalPrice = 0.0;
            $totalCommission = 0.0;
            $items = $this->itemModel->where('sale_id', '=', $sale['id'])
                                     ->with('product')
                                     ->get()
                                     ->toArray();
            
            $salesmanHire = new \DateTime($sale['salesman']['hire_date']);
            $diff = $salesmanHire->diff($today);
            $diff = $diff->y;                       
            
            foreach ($items as $item) {
                $price = $item['product']['price'] * $item['qt'];
                $totalPrice += $price;

                $comission = 10.0;
                if ($diff > 5) {
                    $comission = Model::$OLD_SALESMAN_COMISSION;
                } else if ($item['product']['type'] == '1') {
                    $comission = 25.0;
                }
                $totalCommission += ($price * $comission) / 100; 
            }

            $list[$i]['items'] = $items;
            $list[$i]['total_price'] = $totalPrice;
            $list[$i]['total_comission'] = $totalCommission;
        }

        return $list;
    }

    public function create(array $resource)
    {
        $sale = $this->model->create($resource)->toArray();

        foreach ($resource['items'] as $item) {
            (new ItemModel())->create([
                'product_id' => $item['products']['id'],
                'sale_id' => $sale['id'],
                'qt' => $item['qt'],
            ]);
        }

        return $sale;
    }
}
