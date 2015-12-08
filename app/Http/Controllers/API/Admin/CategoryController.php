<?php

namespace CodeDelivery\Http\Controllers\API\Admin;

use CodeDelivery\Http\Controllers\EntityController;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\Contracts\CategoryRepository;
use CodeDelivery\Services\CategoryService;

class CategoryController extends EntityController
{
    /**
     * CategoryController constructor.
     * @param CategoryRepository $repository
     * @param CategoryService $service
     */
    public function __construct(CategoryRepository $repository, CategoryService $service)
    {
        parent::__construct($repository, $service);
    }
}