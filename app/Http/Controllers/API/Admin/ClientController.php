<?php

namespace CodeDelivery\Http\Controllers\API\Admin;

use CodeDelivery\Http\Controllers\EntityController;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\Contracts\ClientRepository;
use CodeDelivery\Services\ClientService;

class ClientController extends EntityController
{
    public function __construct(ClientRepository $repository, ClientService $service)
    {
        parent::__construct($repository, $service);
    }
}