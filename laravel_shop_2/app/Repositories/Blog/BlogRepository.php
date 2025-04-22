<?php
namespace App\Repositories\Blog;
use App\Models\Blog;
use App\Repositories\BaseRepositories;
use App\Repositories\Blog\BlogRepositoryInterface;

class BlogRepository extends BaseRepositories implements BlogRepositoryInterface {
    public function getModel() {
        return Blog::class;
    }

    public function getLastestBlogs($limit = 3) {
        return $this->model->orderBy('id','desc')
        ->limit($limit)
        ->get();
    }
}