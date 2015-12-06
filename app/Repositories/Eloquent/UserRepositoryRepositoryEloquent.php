<?php

namespace CodeDelivery\Repositories\Eloquent;

use CodeDelivery\Entities\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\Contracts\UserRepositoryRepository;

/**
 * Class UserRepositoryRepositoryEloquent
 * @package namespace CodeDelivery\Repositories\Eloquent;
 */
class UserRepositoryRepositoryEloquent extends BaseRepository implements UserRepositoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
