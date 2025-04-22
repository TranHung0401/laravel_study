<?php

namespace App\Services\Order;

use App\Services\BaseService;
use App\Repositories\Order\OrderRepository;

class OrderService extends BaseService implements OrderServiceInterface {
    public $repository;

    public function __construct(OrderRepository $orderRepository) {
        $this->repository = $orderRepository;
    }

    public function getOderByUserId($userId)
    {
        return $this->repository->getOderByUserId($userId);
    }

}