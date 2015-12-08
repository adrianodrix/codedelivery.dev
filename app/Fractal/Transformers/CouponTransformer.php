<?php

namespace CodeDelivery\Fractal\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Entities\Coupon;

/**
 * Class CouponTransformer
 * @package namespace CodeDelivery\Fractal\Transformers;
 */
class CouponTransformer extends TransformerAbstract
{

    /**
     * Transform the \Coupon entity
     * @param \Coupon $model
     *
     * @return array
     */
    public function transform(Coupon $model)
    {
        return [
            'id' => (int) $model->id,
            'code' => $model->code,
            'value' => (float) $model->value,
            'used' => (boolean) $model->used,
            'created_at' => $model->created_at->format('Y-m-d H:i:s'),
            'created_at_for_humans' => $model->created_at->diffForHumans(),
            'updated_at' => $model->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
