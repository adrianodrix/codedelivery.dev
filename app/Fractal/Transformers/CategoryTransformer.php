<?php

namespace CodeDelivery\Fractal\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Entities\Category;

/**
 * Class CategoryTransformer
 * @package namespace CodeDelivery\Fractal\Transformers;
 */
class CategoryTransformer extends TransformerAbstract
{

    /**
     * Transform the \Category entity
     * @param \Category $model
     *
     * @return array
     */
    public function transform(Category $model)
    {
        return [
            'id'         => (int) $model->id,
            'name' => $model->name,
            'created_at' => $model->created_at,
            'created_at_for_humans' => $model->created_at->diffForHumans(),
            'updated_at' => $model->updated_at,
        ];
    }
}
