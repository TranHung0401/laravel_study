<?php
namespace Modules\User\src\Repositories;
use Modules\User\src\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Modules\User\src\Repositories\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface{
    public function getModel() {
        return User::class;
    }

    public function getUser($limit) {
        return $this->model->paginate($limit);
    }

    public function getAllUsers() {
        return $this->model->select('id','name','email','group_id','created_at');
    }

    public function setPassword($password, $id) {
        return $this->update(['password' => Hash::make($password)],$id);
    }

    public function checkPassword($password, $id){
        $user = $this->find($id);
        if($user) {
            return Hash::check($password, $user->password);
        }
    }
}