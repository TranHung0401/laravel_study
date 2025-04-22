<?php

namespace App\Providers;

use App\Services\Blog\BlogService;
use App\Services\User\UserService;
use App\Services\Brand\BrandService;
use App\Services\Order\OrderService;
use Illuminate\Support\ServiceProvider;
use App\Services\Comment\CommentService;
use App\Services\Product\ProductService;
use App\Repositories\User\UserRepository;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Order\OrderRepository;
use App\Services\Blog\BlogServiceInterface;
use App\Services\User\UserServiceInterface;
use App\Services\Brand\BrandServiceInterface;
use App\Services\Order\OrderServiceInterface;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Product\ProductRepository;
use App\Services\OrderDetail\OrderDetailService;
use App\Services\Comment\CommentServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderDetail\OrderDetailRepository;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\ProductCategory\ProductCategoryService;
use App\Services\OrderDetail\OrderDetailServiceInterface;
use App\Repositories\ProductCategory\ProductCategoryRepository;
use App\Repositories\OrderDetail\OrderDetailRepositoryInterface;
use App\Services\ProductCategory\ProductCategoryServiceInterface;
use App\Repositories\ProductCategory\ProductCategoryRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Product
        $this->app->singleton(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->singleton(
            ProductServiceInterface::class,
            ProductService::class
        );

        // Comment
        $this->app->singleton(
            CommentRepositoryInterface::class,
            CommentRepository::class
        );

        $this->app->singleton(
            CommentServiceInterface::class,
            CommentService::class
        );

        // Blog

        $this->app->singleton(
            BlogRepositoryInterface::class,
            BlogRepository::class
        );

        $this->app->singleton(
            BlogServiceInterface::class,
            BlogService::class
        );

        // Product Category

        $this->app->singleton(
            ProductCategoryRepositoryInterface::class,
            ProductCategoryRepository::class
        );

        $this->app->singleton(
            ProductCategoryServiceInterface::class,
            ProductCategoryService::class
        );

        // Brand

        $this->app->singleton(
            BrandRepositoryInterface::class,
            BrandRepository::class
        );

        $this->app->singleton(
            BrandServiceInterface::class,
            BrandService::class
        );

        // Order

        $this->app->singleton(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );

        $this->app->singleton(
            OrderServiceInterface::class,
            OrderService::class
        );

        // Order Detail

        $this->app->singleton(
            OrderDetailRepositoryInterface::class,
            OrderDetailRepository::class
        );

        $this->app->singleton(
            OrderDetailServiceInterface::class,
            OrderDetailService::class
        );

        // User

        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->singleton(
            UserServiceInterface::class,
            UserService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
