<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Blog\BlogServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Services\ProductCategory\ProductCategoryServiceInterface;

class HomeController extends Controller
{
    private $productService;
    private $blogService;

    public function __construct(ProductServiceInterface $productService,
                                BlogServiceInterface $blogService) {
        $this->productService = $productService;
        $this->blogService = $blogService;
    }

    public function index() {

        $featuredProduct = $this->productService->getFeaturedProducts();

        $blogs = $this->blogService->getLastestBlogs();

        return view('front.index',compact('featuredProduct','blogs'));

    }
}
