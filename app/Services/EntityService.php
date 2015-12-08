<?php

namespace CodeDelivery\Services;

use CodeDelivery\Services\Contracts\ServiceInterface;
use Prettus\Repository\Eloquent\BaseRepository;

abstract class EntityService implements ServiceInterface
{
    /**
     * @var \Prettus\Repository\Eloquent\BaseRepository
     */
    protected $repository;

    /**
     * @param BaseRepository $repository
     */
    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return array|mixed
     */
    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @return array|mixed
     */
    public function update(array $data, $id)
    {
        return $this->repository->update($data, $id);
    }


    /**
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        return [
            'data' => [
                'result' => $this->repository->delete($id),
            ],
        ];
    }
}
