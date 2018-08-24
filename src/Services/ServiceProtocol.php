<?php

namespace App\Services;

interface ServiceProtocol
{
    public function list($search): array;
    public function create(array $resource): array;
    public function update(int $id, array $data): array;
    public function destroy(int $id);
    public function find(int $id): array;
}
