<?php

namespace Tw\Admin\Repositories\interface;

interface RouteRepositoryInterface
{
    public function getRouteAll();

    public function createRoute(array $data);

    public function getRouteById(int $id);

    public function updateRoute(int $id, array $data);

    public function deleteRoute(int $id);

    public function getTreeRoute(array $columns = ['*']);
}
