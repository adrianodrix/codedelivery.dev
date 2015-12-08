<?php

namespace CodeDelivery\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\Contracts\OrderItemRepository;
use CodeDelivery\Entities\OrderItem;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class OrderItemRepositoryEloquent
 * @package namespace CodeDelivery\Repositories\Eloquent;
 */
class OrderItemRepositoryEloquent extends BaseRepository implements OrderItemRepository
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'order_id' => 'required|integer|exists:orders,id',
            'product_id' => 'required|integer|exists:products,id',
            'price' => 'required|number|min:0',
            'quantity' => 'required|number|min:0',
        ],

        ValidatorInterface::RULE_UPDATE => [
            'order_id' => 'sometimes|required|integer|exists:orders,id',
            'product_id' => 'sometimes|required|integer|exists:products,id',
            'price' => 'sometimes|required|number|min:0',
            'quantity' => 'sometimes|required|number|min:0',
        ],
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderItem::class;
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
        return \CodeDelivery\Fractal\Presenters\OrderItemPresenter::class;
    }
}
