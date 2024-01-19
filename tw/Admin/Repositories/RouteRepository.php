<?php

namespace Tw\Admin\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Tw\Admin\Repositories\interface\RouteRepositoryInterface;
use Tw\Models\Route;

class RouteRepository implements RouteRepositoryInterface
{

    public function getRouteAll()
    {
        return Route::query()->paginate(pageSize());
    }

    public function createRoute(array $data)
    {
        return Route::query()->create($data);
    }

    public function getRouteById(int $id): Model|Collection|Builder|array|null
    {
        return Route::query()->findOrFail($id);
    }

    public function updateRoute(int $id, array $data)
    {
        $route = Route::query()->findOrFail($id);
        return $route->update($data);
    }

    public function deleteRoute(int $id): ?bool
    {
        return Route::query()->findOrFail($id)->deleteOrFail();
    }

    public function getTreeRoute(array $columns = ['*']): Collection|array
    {
        return Route::query()
                    ->orderBy('weight')
                    ->with(['children' => fn($query) => $query->orderBy('weight')->select($columns)])->select($columns)
                    ->where('pid', 0)->get();
    }
}
