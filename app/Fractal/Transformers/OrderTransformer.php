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
    protected $availableIncludes = [
        'client',
        'items',
    ];

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
            'created_at' => $model->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $model->updated_at->format('Y-m-d H:i:s')
        ];
    }

    public function includeClient(Order $model)
    {
        return $this->item($model->client, $this->setTransformer(new ClientTransformer()));
    }

    public function includeItems(Order $model)
    {
        return $this->collection($model->items, $this->setTransformer(new OrderItemTransformer()));
    }

    private function setTransformer($transformer)
    {
        $transformer->setDefaultIncludes([]);
        return $transformer;
    }
}
