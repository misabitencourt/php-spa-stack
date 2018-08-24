<?php

namespace App\Repositories;

use App\Models\Product as Model;
use App\Exceptions\NotFoundException;
use App\Exceptions\InvalidException;

class Product extends BaseRepository
{
    protected $searchable = [
        'name',
        'description',
    ];

    function __construct()
    {
        parent::__construct(new Model);
    }
}
