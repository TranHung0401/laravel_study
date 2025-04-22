<?php

namespace App\Services\Blog;

use App\Services\BaseService;
use App\Repositories\Blog\BlogRepository;

class BlogService extends BaseService implements BlogServiceInterface {
    public $repository;

    public function __construct(BlogRepository $blogRepository) {
        $this->repository = $blogRepository;
    }

    public function getLastestBlogs($limit = 3) 
    {
        return $this->repository->getLastestBlogs($limit);
    }

}