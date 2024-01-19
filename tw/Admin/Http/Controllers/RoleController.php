<?php

namespace Tw\Admin\Http\Controllers;

use Tw\Admin\Http\Requests\RoleRequest;
use Tw\Admin\Repositories\interface\RoleRepositoryInterface;

class RoleController extends Controller
{
    public function __construct(protected readonly RoleRepositoryInterface $roleRepository)
    {
    }

    public function index()
    {
        return json_success($this->roleRepository->getRoleList(request()->input()));
    }

    public function store(RoleRequest $request)
    {
        $this->roleRepository->createRole($request->validated());
        return json_success(trans('common.add-success'));
    }

    public function show(int $id)
    {
        return json_success($this->roleRepository->getRoleById($id));
    }

    public function update(int $id, RoleRequest $request)
    {
        $this->roleRepository->updateRole($id, $request->validated());
        return json_success(trans('common.update-success'));
    }

    public function destroy(int $id)
    {
        $this->roleRepository->deleteRole($id);
        return json_success(trans('common.del-success'));
    }

}
