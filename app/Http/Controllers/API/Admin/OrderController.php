<?php

namespace CodeDelivery\Http\Controllers\API\Admin;

use CodeDelivery\Http\Controllers\EntityController;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\Contracts\OrderRepository;
use CodeDelivery\Services\OrderService;

class OrderController extends EntityController
{
    public function __construct(OrderRepository $repository, OrderService $service)
    {
        parent::__construct($repository, $service);
    }
}