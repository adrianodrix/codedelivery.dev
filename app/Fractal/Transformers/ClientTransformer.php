<?php

namespace CodeDelivery\Fractal\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Entities\Client;

/**
 * Class ClientTransformer
 * @package namespace CodeDelivery\Fractal\Transformers;
 */
class ClientTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['user'];

    /**
     * Transform the \Client entity
     * @param \Client $model
     *
     * @return array
     */
    public function transform(Client $model)
    {
        return [
            'id'         => (int) $model->id,
            'user_id'    => (int) $model->user_id,
            'phone'      => $model->phone,
            'address'    => $model->address,
            'city'       => $model->city,
            'state'      => $model->state,
            'postcode'    => $model->postcode,
            'created_at' => $model->created_at->format('Y-m-d H:i:s'),
            'created_at_for_humans' => $model->created_at->diffForHumans(),
            'updated_at' => $model->updated_at->format('Y-m-d H:i:s')
        ];
    }

    public function includeUser(Client $model)
    {
        return $this->item($model->user, $this->setTransformer(new UserTransformer()));
    }

    private function setTransformer($transformer)
    {
        $transformer->setDefaultIncludes([]);
        return $transformer;
    }
}
