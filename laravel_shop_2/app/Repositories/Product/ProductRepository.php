<?php
namespace App\Repositories\Product;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Repositories\BaseRepositories;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductRepository extends BaseRepositories implements ProductRepositoryInterface {
    public function getModel() {
        return Product::class;
    }

    public function getRelatedProducts($product, $limit = 4) {
        return $this->model->where('product_category_id',$product->product_category_id)->where('tag',$product->tag)->limit($limit)->get();
    }
    
    public function getFeaturedProductsByCategory($categoryId) 
    {
        return $this->model->where('featured',true)
        ->where('product_category_id',$categoryId)
        ->get();
    }

    public function getProductOnIndex($request)
    {
        $search = $request->search ?? '';

        $products = $this->model->where('name','like','%'.$search.'%');

        $products = $this->filter($products,$request);

        $products = $this->sortAndPagination($products, $request);

        return $products;
    }

    public function getProductsByCategory($categoryName,$request) 
    {
        $products = ProductCategory::where('name',$categoryName)->first()->products->toQuery();

        $products = $this->filter($products,$request);

        $products = $this->sortAndPagination($products,$request);

        return $products;
    }

    private function sortAndPagination($products, Request $request)
    {
        $perPage = $request->show ?? 3;

        $sortBy = $request->sort_by ?? "latest";

        switch ($sortBy) {
            case 'latest':
                $products = $products->orderBy('id');
            break;

            case 'oldest':
                $products = $products->orderByDesc('id');
            break;

            case 'name-ascending':
                $products = $products->orderBy('name');
            break;

            case 'name-descending':
                $products = $products->orderByDesc('name');
            break;

            case 'price-ascending':
                $products = $products->orderBy('price');
            break;

            case 'price-descending':
                $products = $products->orderByDesc('price');
            break;
            
            default:
                $products = $products->orderBy('id');
            break;
        }

        $products = $products->paginate($perPage);

        // $products = $products->appends(['sort_by'=>$sortBy,'show'=>$perPage]);
        $products = $products->appends($request->query());

        return $products;

    }

    private function filter($products, Request $request)
    {
        // Brand
        $brands = $request->brand ?? [];

        $brand_ids = array_keys($brands);

        $products = $brand_ids != null ? $products->whereIn('brand_id', $brand_ids) : $products;

        // Price
        $priceMin = str_replace('$','',$request->price_min);
        $priceMax = str_replace('$','',$request->price_max);

        $products = ($priceMin != null && $priceMax != null) 
        ? $products->whereBetween('price',[$priceMin,$priceMax])
        : $products;

        // Color
        $color = $request->color;

        $products = $color != null
        ? $products->whereHas('productDetails', function($query) use ($color)  {
            $query->where('color', $color)->where('qty','>',0);
        })
        : $products;  
        
        // Size
        $size = $request->size;

        $products = $size != null
        ? $products->whereHas('productDetails', function($query) use ($size)  {
            $query->where('size', $size)->where('qty','>',0);
        })
        : $products;  


        return $products;
    }
}