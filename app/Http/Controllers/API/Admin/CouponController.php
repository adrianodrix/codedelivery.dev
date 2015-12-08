<?php

namespace CodeDelivery\Http\Controllers\API\Admin;

use CodeDelivery\Http\Controllers\EntityController;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\Contracts\CouponRepository;
use CodeDelivery\Services\CouponService;

class CouponController extends EntityController
{
    public function __construct(CouponRepository $repository, CouponService $service)
    {
        parent::__construct($repository, $service);
    }
}