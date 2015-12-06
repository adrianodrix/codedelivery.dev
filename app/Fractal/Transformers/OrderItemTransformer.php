<?php

namespace CodeDelivery\Fractal\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Entities\OrderItem;

/**
 * Class OrderItemTransformer
 * @package namespace CodeDelivery\Fractal\Transformers;
 */
class OrderItemTransformer extends TransformerAbstract
{

    /**
     * Transform the \OrderItem entity
     * @param \OrderItem $model
     *
     * @return array
     */
    public function transform(OrderItem $model)
    {
        return [
            'id'         => (int) $model->id,
            'order_id' => (int) $model->order_id,
            'product_id' => (int) $model->product_id,
            'price' => (float) $model->price,
            'quantity' => (float) $model->quantity,
            'total' => (float) $model->price * $model->quantity,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
