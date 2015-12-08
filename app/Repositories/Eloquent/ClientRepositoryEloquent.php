<?php

namespace CodeDelivery\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\Contracts\ClientRepository;
use CodeDelivery\Entities\Client;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class ClientRepositoryEloquent
 * @package namespace CodeDelivery\Repositories\Eloquent;
 */
class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'user_id' => 'required|integer|exists:users,id',
        ],

        ValidatorInterface::RULE_UPDATE => [
            'user_id' => 'sometimes|required|integer|exists:users,id',
        ],
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Client::class;
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
        return \CodeDelivery\Fractal\Presenters\ClientPresenter::class;
    }

}
