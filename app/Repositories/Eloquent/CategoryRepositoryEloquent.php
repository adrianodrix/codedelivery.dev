<?php

namespace CodeDelivery\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\Contracts\CategoryRepository;
use CodeDelivery\Entities\Category;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace CodeDelivery\Repositories\Eloquent;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
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
        return \CodeDelivery\Fractal\Presenters\CategoryPresenter::class;
    }
}
