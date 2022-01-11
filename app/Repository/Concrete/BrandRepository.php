<?php

namespace App\Repository\Concrete;

use App\Repository\Interfaces\IBrandRepository;
use App\Models\Brand;

class BrandRepository extends BaseRepository implements IBrandRepository
{
    public function __construct(Brand $model)
    {
        parent::__construct($model);
    }
}
