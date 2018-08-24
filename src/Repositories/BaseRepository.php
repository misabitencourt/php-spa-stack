<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;
    protected $searchable = [
        'name',
    ];

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function list(string $search = null): array
    {
        $resource = $this->model
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc');

        if ($search !== null) {
            foreach ($this->searchable as $index => $field) {
                if ($index === 0) {
                    $resource->where($field, 'LIKE', '%'.$search.'%');
                    continue;
                }
                $resource->orWhere($field, 'LIKE', '%'.$search.'%');
            }
        }

        return $resource->limit(25)->get()->toArray();
    }

    public function create(array $resource)
    {
        return $this->model->create($resource)->toArray();
    }

    public function update(int $id, array $data)
    {
        $resource = $this->model->find($id);

        if (!$resource) {
            throw new NotFoundException();
        }

        $resource->fill($data)->save();

        return $resource->toArray();
    }

    public function destroy(int $id)
    {
        $resource = $this->model->find($id);

        if (!$resource) {
            throw new NotFoundException();
        }

        $resource->delete();
    }

    public function find(int $id): array
    {
        $resource = $this->model->find($id);

        if (!$resource) {
            throw new NotFoundException();
        }

        return $resource->toArray();
    }
}
