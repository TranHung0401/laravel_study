<?php

namespace App\Services\User;
use App\Services\BaseService;
use App\Repositories\User\UserRepository;

class UserService extends BaseService implements UserServiceInterface {
    public $repository;

    public function __construct(UserRepository $userRepository) {
        $this->repository = $userRepository;
    }

}