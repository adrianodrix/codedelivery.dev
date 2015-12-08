<?php

namespace CodeDelivery\Services;

use CodeDelivery\Repositories\Contracts\CategoryRepository;

class CategoryService extends EntityService
{
    public function __construct(CategoryRepository $repository)
    {
        parent::__construct($repository);
    }
}