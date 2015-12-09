<?php

namespace CodeDelivery\Repositories\Eloquent;

use CodeDelivery\Entities\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\Contracts\UserRepository;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class UserRepositoryRepositoryEloquent
 * @package namespace CodeDelivery\Repositories\Eloquent;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    protected $fieldSearchable = [
        'name',
        'email'
    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|min:6',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ],

        ValidatorInterface::RULE_UPDATE => [
            'name' => 'sometimes|required',
            'email' => 'sometimes|required|email|unique:users',
            'password' => 'sometimes|required|size:6',
        ],
    ];

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


    public function presenter()
    {
        return \CodeDelivery\Fractal\Presenters\UserPresenter::class;
    }

    public function getDeliveryMen()
    {
        return $this->model->where(['role' => 'deliveryman'])->list('name', 'id');
    }
}
