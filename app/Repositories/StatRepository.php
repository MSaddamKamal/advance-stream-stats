<?php

namespace App\Repositories;

use App\Models\Stat;


class StatRepository extends AbstractRepository
{
    protected $model;

    public function __construct(Stat $model)
    {
        $this->model = $model;
    }

}