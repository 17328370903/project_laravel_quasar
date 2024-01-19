<?php

namespace Tw\Admin\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Tw\Admin\Repositories\interface\RoleRepositoryInterface;
use Tw\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    public function getRoleList(array $data = []): LengthAwarePaginator
    {
        return Role::query()->paginate(pageSize());
    }

    public function getRoleById(int $id): Model|Collection|Builder|array|null
    {
        return Role::query()->with(['routes:id'])->findOrFail($id);
    }

    public function createRole(array $data)
    {
        $role = Role::query()->create($data);
        empty($data) ?: $role->routes()->sync($data['routes']);

        return $role;
    }

    public function updateRole(int $id, array $data): bool|int
    {
        $role = Role::query()->findOrFail($id);
        $role->routes()->sync($data['routes']);
        return $role->update($data);
    }

    public function deleteRole(int $id)
    {
        return Role::query()->findOrFail($id)->delete();
    }

    public function getRoleAll(array $column = ['*'])
    {
        return Role::query()->select($column)->get();
    }

    public function getRoleByIds(array $ids)
    {
        return Role::query()->with(['routes'])->whereIn('id', $ids)->get();
    }
}
