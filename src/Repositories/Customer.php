<?php

namespace App\Repositories;

use App\Models\Customer as Model;
use App\Exceptions\NotFoundException;
use App\Exceptions\InvalidException;

class Customer extends BaseRepository
{
    protected $searchable = [
        'name',
    ];

    function __construct()
    {
        parent::__construct(new Model);
    }
}
