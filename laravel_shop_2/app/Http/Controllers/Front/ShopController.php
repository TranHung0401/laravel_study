<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Brand\BrandServiceInterface;
use App\Services\Comment\CommentServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Services\ProductCategory\ProductCategoryServiceInterface;

class ShopController extends Controller
{
    private $productService;
    private $commentService;
    private $productCategoryService;
    private $brandService;

    public function __construct(ProductServiceInterface $productService, 
                                CommentServiceInterface $commentService,
                                ProductCategoryServiceInterface $productCategoryService,
                                BrandServiceInterface $brandService) {
        $this->productService = $productService;
        $this->commentService = $commentService;
        $this->productCategoryService = $productCategoryService;
        $this->brandService = $brandService;
    }

    public function show($id) {

        $categories = $this->productCategoryService->all();

        $brands = $this->brandService->all();

        $product = $this->productService->findProduct($id);

        $relatedProducts = $this->productService->getRelatedProducts($product);

        $avgRating = 0;

        $sumRating = array_sum(array_column($product->productComments->toArray(), 'rating'));
        $countRating = count($product->productComments);

        if($countRating > 0){
            $avgRating = $sumRating/$countRating;

        }

        return view('front.shop.show',compact('product','avgRating','relatedProducts','categories','brands'));
    }

    public function postComment(Request $request) {
        $this->commentService->create($request->all());
        return back();
    }

    public function index(Request $request) 
    {
        $products = $this->productService->getProductOnIndex($request);

        $categories = $this->productCategoryService->all();

        $brands = $this->brandService->all();

        return view('front.shop.index',compact('products','categories','brands'));
    }

    public function category($categoryName,Request $request) {

        $products = $this->productService->getProductsByCategory($categoryName,$request);

        $categories = $this->productCategoryService->all();

        $brands = $this->brandService->all();

        return view('front.shop.index',compact('products','categories','brands'));

    }
}
