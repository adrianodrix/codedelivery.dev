<?php

namespace CodeDelivery\Http\Controllers\API\Admin;

use CodeDelivery\Http\Controllers\EntityController;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\Contracts\UserRepository;
use CodeDelivery\Services\UserService;
use Illuminate\Http\Request;

class UserController extends EntityController
{
    /**
     * UserController constructor.
     * @param UserRepository $repository
     * @param UserService $service
     */
    public function __construct(UserRepository $repository, UserService $service)
    {
        parent::__construct($repository, $service);
    }

    public function authenticated()
    {
        return $this->repository->find(\Authorizer::getResourceOwnerId());
    }

    public function forgotPassword(Request $request)
    {
        throw new \Exception('Desculpe, mas este recurso ainda não foi implementado!');
        return $request->all();
    }
}