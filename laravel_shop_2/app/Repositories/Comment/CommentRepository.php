<?php
namespace App\Repositories\Comment;
use App\Models\Comment;
use App\Models\ProductComment;
use App\Repositories\BaseRepositories;
use App\Repositories\Comment\CommentRepositoryInterface;

class CommentRepository extends BaseRepositories implements CommentRepositoryInterface {
    public function getModel() {
        return ProductComment::class;
    }
}