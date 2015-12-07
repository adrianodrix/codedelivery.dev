<?php

namespace CodeDelivery\Repositories\Eloquent;

use CodeDelivery\Fractal\Presenters\ProductPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\Contracts\ProductRepository;
use CodeDelivery\Entities\Product;

/**
 * Class ProductRepositoryEloquent
 * @package namespace CodeDelivery\Repositories\Eloquent;
 */
class ProductRepositoryEloquent extends BaseRepository implements ProductRepository
{
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
