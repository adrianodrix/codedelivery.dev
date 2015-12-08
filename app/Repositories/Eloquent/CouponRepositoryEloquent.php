<?php

namespace CodeDelivery\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\Contracts\CouponRepository;
use CodeDelivery\Entities\Coupon;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class CouponRepositoryEloquent
 * @package namespace CodeDelivery\Repositories\Eloquent;
 */
class CouponRepositoryEloquent extends BaseRepository implements CouponRepository
{
    protected $fieldSearchable = [
        'code',
    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'code' => 'required|unique:coupons|min:6|max:255',
            'value' => 'required|numeric',
            'used' => 'boolean'
        ],

        ValidatorInterface::RULE_UPDATE => [
            'code' => 'sometimes|required|unique:coupons|min:6|max:255',
            'value' => 'sometimes|required|numeric',
            'used' => 'sometimes|boolean'
        ],
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Coupon::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return \CodeDelivery\Fractal\Presenters\CouponPresenter::class;
    }
}
