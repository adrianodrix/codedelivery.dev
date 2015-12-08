<?php

namespace CodeDelivery\Services;

use CodeDelivery\Repositories\Contracts\ProductRepository;

class ProductService extends EntityService
{
    public function __construct(ProductRepository $repository)
    {
        parent::__construct($repository);
    }
}