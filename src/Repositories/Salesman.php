<?php

namespace App\Repositories;

use App\Models\Salesman as Model;
use App\Exceptions\NotFoundException;
use App\Exceptions\InvalidException;

class Salesman extends BaseRepository
{
    protected $searchable = [
        'name',
        'email',
        'phone',
    ];

    function __construct()
    {
        parent::__construct(new Model);
    }
}
