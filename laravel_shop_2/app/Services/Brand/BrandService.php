<?php

namespace App\Services\Brand;

use App\Services\BaseService;
use App\Repositories\Brand\BrandRepository;

class BrandService extends BaseService implements BrandServiceInterface {
    public $repository;

    public function __construct(BrandRepository $brandRepository) {
        $this->repository = $brandRepository;
    }

}