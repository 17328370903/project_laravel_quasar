<?php

namespace Tw\Admin\Http\Controllers;

use Tw\Admin\Http\Requests\AdminRequest;
use Tw\Admin\Repositories\interface\AdminRepositoryInterface;

class AdminController extends Controller
{

    public function __construct(protected readonly AdminRepositoryInterface $adminRepository)
    {
    }

    public function index()
    {
        return json_success($this->adminRepository->getAdminList());
    }

    public function store(AdminRequest $request)
    {
        $this->adminRepository->createAdmin($request->validated());
        return json_success(trans('common.add-success'));
    }

    public function show(int $id)
    {
        return json_success($this->adminRepository->getAdminById($id));
    }

    public function update(int $id, AdminRequest $request)
    {
        $data = $request->validated();
        if (empty($data['password'])) {
            unset($data['password']);
        }
        $this->adminRepository->update($id, $data);
        return json_success(trans('common.update-success'));
    }

    public function destroy(int $id)
    {
        if ($id == 1) {
            return json_error();
        }
        $this->adminRepository->deleteAdmin($id);
        return json_success(trans('common.delete-success'));

    }


}
