<?php

namespace CodeDelivery\Fractal\Transformers;

use CodeDelivery\Entities\User;
use League\Fractal\TransformerAbstract;
use CodeDelivery\Entities\Order;

/**
 * Class OrderTransformer
 * @package namespace CodeDelivery\Fractal\Transformers;
 */
class OrderTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'client',
        'deliveryMan',
    ];

    protected $availableIncludes = [
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
        if (!$model->client){
            return;
        }
        return $this->item($model->client, $this->setTransformer(new ClientTransformer()));
    }

    public function includeDeliveryMan(Order $model)
    {
        if (!$model->deliveryMan){
            return;
        }
        return $this->item($model->deliveryMan, $this->setTransformer(new UserTransformer()));
    }

    public function includeItems(Order $model)
    {
        if (!$model->items){
            return;
        }
        return $this->collection($model->items, $this->setTransformer(new OrderItemTransformer()));
    }

    private function setTransformer($transformer)
    {
        $transformer->setDefaultIncludes([]);
        return $transformer;
    }
}
