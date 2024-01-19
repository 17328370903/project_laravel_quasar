<?php

namespace Tw\Admin\Repositories;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Tw\Admin\Repositories\interface\AdminRepositoryInterface;
use Tw\Models\Admin;


class AdminRepository implements AdminRepositoryInterface
{

    public function getAdminById(int $id): Model|array|null
    {
        return Admin::query()->with(['roles:id,name'])->findOrFail($id);
    }

    public function getAdminByEmail(string $email): Model|Builder|null
    {
        return Admin::query()->where('email', $email)->first();
    }

    public function update(int $id, array $data)
    {
        $admin = Admin::query()->findOrFail($id);
        !empty($data['roles']) && $admin->roles()->sync($data['roles']);
        return $admin->updateOrFail($data);
    }

    public function getAdminList(array $filter = []): LengthAwarePaginator
    {
        return Admin::query()->with(['roles:id,name'])->paginate(pageSize(),);
    }

    public function createAdmin(array $data): Model|Builder
    {
        $admin = Admin::query()->createOrFirst($data);
        $admin->roles()->sync($data['roles']);
        return $admin;
    }

    public function deleteAdmin(int $id)
    {
        return $this->getAdminById($id)->deleteOrFail();
    }

}
