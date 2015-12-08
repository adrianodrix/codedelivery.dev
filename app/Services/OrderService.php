<?php

namespace CodeDelivery\Services;

use CodeDelivery\Repositories\Contracts\OrderRepository;

class OrderService extends EntityService
{
    public function __construct(OrderRepository $repository)
    {
        parent::__construct($repository);
    }
}