<?php

namespace CodeDelivery\Fractal\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Entities\User;

/**
 * Class UserPresenterTransformer
 * @package namespace CodeDelivery\Fractal\Transformers;
 */
class UserTransformer extends TransformerAbstract
{

    /**
     * Transform the \User entity
     * @param \User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id'         => (int) $model->id,
            'name' => $model->name,
            'email' => $model->email,
            'created_at' => $model->created_at,
            'created_at_for_humans' => $model->created_at->diffForHumans(),
            'updated_at' => $model->updated_at,
        ];
    }
}
