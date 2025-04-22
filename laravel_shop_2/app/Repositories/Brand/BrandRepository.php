<?php
namespace App\Repositories\Brand;
use App\Models\Brand;
use App\Repositories\BaseRepositories;
use App\Repositories\Brand\BrandRepositoryInterface;

class BrandRepository extends BaseRepositories implements BrandRepositoryInterface {
    public function getModel() {
        return Brand::class;
    }

}