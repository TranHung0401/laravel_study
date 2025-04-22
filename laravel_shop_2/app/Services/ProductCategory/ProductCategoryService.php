<?php

namespace App\Services\ProductCategory;

use App\Services\BaseService;
use App\Repositories\ProductCategory\ProductCategoryRepository;

class ProductCategoryService extends BaseService implements ProductCategoryServiceInterface {
    public $repository;

    public function __construct(ProductCategoryRepository $productCategoryRepository) {
        $this->repository = $productCategoryRepository;
    }
    
}