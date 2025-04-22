<?php

namespace App\Services\OrderDetail;

use App\Services\BaseService;
use App\Repositories\OrderDetail\OrderDetailRepository;
use App\Services\OrderDetail\OrderDetailServiceInterface;

class OrderDetailService extends BaseService implements OrderDetailServiceInterface {
    public $repository;

    public function __construct(OrderDetailRepository $orderDetailRepository) {
        $this->repository = $orderDetailRepository;
    }

}