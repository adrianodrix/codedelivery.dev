<?php

namespace CodeDelivery\Services;

use CodeDelivery\Repositories\Contracts\UserRepository;

class UserService extends EntityService
{
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }
}