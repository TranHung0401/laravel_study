<?php

namespace App\Services\Comment;

use App\Services\BaseService;
use App\Repositories\Comment\CommentRepository;

class CommentService extends BaseService implements CommentServiceInterface {
    public $repository;

    public function __construct(CommentRepository $commentRepository) {
        $this->repository = $commentRepository;
    }
    
}