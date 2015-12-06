<?php

namespace CodeDelivery\Fractal\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Entities\Order;

/**
 * Class OrderTransformer
 * @package namespace CodeDelivery\Fractal\Transformers;
 */
class OrderTransformer extends TransformerAbstract
{

    /**
     * Transform the \Order entity
     * @param \Order $model
     *
     * @return array
     */
    public function transform(Order $model)
    {
        return [
            'id'         => (int) $model->id,
            'client_id' => (int) $model->client_id,
            'user_deliveryman_id' => (int) $model->user_deliveryman_id,
            'total' => (float) $model->total,
            'status' => (int) $model->status,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
