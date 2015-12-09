<?php

namespace CodeDelivery\Services;

use CodeDelivery\Repositories\Contracts\UserRepository;

class UserService extends EntityService
{
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param array $data
     * @return array|mixed
     */
    public function create(array $data)
    {
        if ($data['password']){
            $data['password'] = bcrypt($data['password']);
        }
        return parent::create($data);
    }
}