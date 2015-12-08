<?php

namespace CodeDelivery\Services;

use CodeDelivery\Repositories\Contracts\ClientRepository;

class ClientService extends EntityService
{
    public function __construct(ClientRepository $repository)
    {
        parent::__construct($repository);
    }
}