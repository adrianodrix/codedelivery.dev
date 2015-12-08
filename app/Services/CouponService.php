<?php

namespace CodeDelivery\Services;

use CodeDelivery\Repositories\Contracts\CouponRepository;

class CouponService extends EntityService
{
    public function __construct(CouponRepository $repository)
    {
        parent::__construct($repository);
    }
}