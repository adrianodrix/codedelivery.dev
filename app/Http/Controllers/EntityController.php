<?php

namespace CodeDelivery\Http\Controllers;

use Illuminate\Http\Request;
use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Support\Facades\Response;
use CodeDelivery\Services\EntityService;


abstract class EntityController extends Controller
{
    /**
     * @var BaseRepository
     */
    protected $repository;

    /**
     * @var Service
     */
    protected $service;

    /**
     * EntityController constructor.
     * @param BaseRepository $repository
     * @param EntityService $service
     */
    public function __construct(BaseRepository $repository, EntityService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        if($request->query->get('paginate') === 'false'){
            return $this->repository->all();
        }
        return $this->repository->paginate($request->query->get('limit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
