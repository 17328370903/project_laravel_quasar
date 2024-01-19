<?php

namespace Tw\Admin\Http\Controllers;

use Tw\Admin\Http\Requests\RouteRequest;
use Tw\Admin\Repositories\interface\RouteRepositoryInterface;

class RouteController extends Controller
{

    public function __construct(protected readonly RouteRepositoryInterface $routeRepository)
    {
    }

    public function index()
    {
        return json_success($this->routeRepository->getTreeRoute());
    }

    public function store(RouteRequest $request)
    {
        $this->routeRepository->createRoute($request->validated());
        return json_success(trans("common.add-success"));
    }

    public function show(int $id)
    {
        return json_success($this->routeRepository->getRouteById($id));
    }

    public function update(RouteRequest $request, int $id)
    {
        $this->routeRepository->updateRoute($id, $request->validated());
        return json_success(trans("common.update-success"));
    }

    public function destroy(int $id)
    {
        $this->routeRepository->deleteRoute($id);
        return json_success(trans("common.del-success"));
    }

}
