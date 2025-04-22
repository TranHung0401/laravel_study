<?php
namespace App\Repositories\Order;
use App\Models\Order;
use App\Repositories\BaseRepositories;
use App\Repositories\Order\OrderRepositoryInterface;

class OrderRepository extends BaseRepositories implements OrderRepositoryInterface {
    public function getModel() {
        return Order::class;
    }

    public function getOderByUserId($userId)
    {
        return $this->model->where('user_id',$userId)->get();
    }

}