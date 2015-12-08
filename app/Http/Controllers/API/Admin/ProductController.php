<?php

namespace CodeDelivery\Http\Controllers\API\Admin;

use CodeDelivery\Http\Controllers\EntityController;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\Contracts\ProductRepository;
use CodeDelivery\Services\ProductService;

class ProductController extends EntityController
{
    public function __construct(ProductRepository $repository, ProductService $service)
    {
        parent::__construct($repository, $service);
    }
}