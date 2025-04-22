<?php
namespace App\Repositories\User;
use App\Models\User;
use App\Repositories\BaseRepositories;
use App\Repositories\User\UserRepositoryInterface;

class UserRepository extends BaseRepositories implements UserRepositoryInterface {
    public function getModel() {
        return User::class;
    }

    
}