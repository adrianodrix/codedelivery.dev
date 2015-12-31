<?php

namespace CodeDelivery\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\Contracts\OrderRepository;
use CodeDelivery\Entities\Order;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class OrderRepositoryEloquent
 * @package namespace CodeDelivery\Repositories\Eloquent;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'client_id' => 'required|integer|exists:users,id',
            'user_deliveryman_id' => 'required|integer|exists:users,id',
            'total' => 'numeric|min:0',
            'status' => 'integer|between:0,2',
            'coupon_id' => 'integer|exists:coupons,id',
        ],

        ValidatorInterface::RULE_UPDATE => [
            'client_id' => 'sometimes|required|integer|exists:users,id',
            'user_deliveryman_id' => 'sometimes|required|integer|exists:users,id',
            'total' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|integer|between:0,2',
            'coupon_id' => 'sometimes|integer|exists:coupons,id',
        ],
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
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
        return \CodeDelivery\Fractal\Presenters\OrderPresenter::class;
    }

}
