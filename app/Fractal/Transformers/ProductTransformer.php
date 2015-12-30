<?php

namespace CodeDelivery\Fractal\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Entities\Product;

/**
 * Class ProductTransformer
 * @package namespace CodeDelivery\Fractal\Transformers;
 */
class ProductTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['category'];

    /**
     * Transform the \Product entity
     * @param \Product $model
     *
     * @return array
     */
    public function transform(Product $model)
    {
        return [
            'id'         => (int) $model->id,
            'category_id'=> (int) $model->category_id,
            'name'       => $model->name,
            'description'=> $model->description,
            'price'      => (float) $model->price,
            'created_at' => $model->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $model->updated_at->format('Y-m-d H:i:s')
        ];
    }

    public function includeCategory(Product $model)
    {
        if ($model->category != null){
            return $this->item($model->category, $this->setTransformer(new CategoryTransformer()));
        }
        return null;
    }

    private function setTransformer($transformer)
    {
        $transformer->setDefaultIncludes([]);
        return $transformer;
    }
}
