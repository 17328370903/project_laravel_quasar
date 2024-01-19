<?php

namespace Tw\Admin\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Tw\Admin\Http\Requests\LoginRequest;
use Tw\Admin\Http\Resources\AdminResource;
use Tw\Admin\Repositories\interface\AdminRepositoryInterface;
use Tw\Models\Admin;

class LoginController extends Controller
{

    public function __construct(protected readonly AdminRepositoryInterface $adminRepository)
    {
    }

    public function index(LoginRequest $request)
    {
        $email    = $request->input('email');
        $password = $request->input('password');
        $admin    = $this->adminRepository->getAdminByEmail($email);


        if (!$admin || !Hash::check($password, $admin->password)) {
            return json_error(trans('common.username-or-password-error'));
        }

        if ($admin->status != Admin::STATUS['normal']) {
            return json_error(trans('user-stop'));
        }

        $this->adminRepository->update($admin->id, [
            'last_login_time' => date('Y-m-d H:i:s'),
            'last_login_ip'   => request()->ip()
        ]);


        return json_success([
            'admin' => new AdminResource($admin),
            'token' => Crypt::encrypt(['id' => $admin->id, 'expired' => time() + config('admin.token_expired')])
        ],
            trans('common.login-success'));
    }
}
