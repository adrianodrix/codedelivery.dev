<?php

namespace CodeDelivery\Repositories\Eloquent;

use CodeDelivery\Fractal\Presenters\ProductPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\Contracts\ProductRepository;
use CodeDelivery\Entities\Product;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class ProductRepositoryEloquent
 * @package namespace CodeDelivery\Repositories\Eloquent;
 */
class ProductRepositoryEloquent extends BaseRepository implements ProductRepository
{
    protected $fieldSearchable = [
        'name',
        'description',
    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'category_id' => 'required|integer|exists:categories,id',
            'name' => 'required|string|min:6',
            'description' => 'string',
            'price' => 'required|numeric|min:0'
        ],

        ValidatorInterface::RULE_UPDATE => [
            'category_id' => 'sometimes|required|integer|exists:categories,id',
            'name' => 'sometimes|required|string|min:6',
            'description' => 'sometimes|string',
            'price' => 'sometimes|required|numeric|min:0'
        ],
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
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
        return ProductPresenter::class;
    }

}
