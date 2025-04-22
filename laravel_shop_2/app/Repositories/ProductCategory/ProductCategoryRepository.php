<?php
namespace App\Repositories\ProductCategory;
use App\Models\ProductCategory;
use App\Models\ProductProductCategory;
use App\Repositories\BaseRepositories;
use App\Repositories\ProductCategory\ProductCategoryRepositoryInterface;

class ProductCategoryRepository extends BaseRepositories implements ProductCategoryRepositoryInterface {
    public function getModel() {
        return ProductCategory::class;
    }
}