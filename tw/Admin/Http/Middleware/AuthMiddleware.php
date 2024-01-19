<?php

namespace Tw\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use Tw\Admin\Repositories\interface\AdminRepositoryInterface;
use Tw\Admin\Repositories\interface\RoleRepositoryInterface;
use Tw\Models\Admin;

/**
 * 是否登录授权
 */
class AuthMiddleware
{

    public function __construct(
        protected readonly AdminRepositoryInterface $adminRepository,
        protected readonly RoleRepositoryInterface  $roleRepository
    )
    {

    }

    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');
        if (!$token) {
            return json_error([], trans('no-login'), Response::HTTP_UNAUTHORIZED);
        }

        $crypt = Crypt::decrypt($token);
        if (empty($crypt) || !is_array($crypt) || empty($crypt['id'] || empty($crypt['expired']))) {
            return json_error([], trans('no-login'), Response::HTTP_UNAUTHORIZED);
        }

        if ($crypt['expired'] < time()) {
            return json_error([], trans('auth-expired'), Response::HTTP_UNAUTHORIZED);
        }

        $admin = $this->adminRepository->getAdminById($crypt['id']);
        if (!$admin instanceof Admin) {
            return json_error([], trans('auth-expired'), Response::HTTP_UNAUTHORIZED);
        }

        if ($admin->status != Admin::STATUS['normal']) {
            return json_error([], trans('user-stop'), Response::HTTP_UNAUTHORIZED);
        }


        if ($this->auth($admin) === false) {
            return json_error([], trans('common.not-auth'), Response::HTTP_FORBIDDEN);
        };


        $request->admin = $admin;


        return $next($request);
    }


    protected function auth(Admin $admin): bool
    {
        $routeName = Route::currentRouteName();
        if (preg_match("/^common\..+$/", $routeName)) {
            return true;
        }

        if (Admin::IS_SUPER['super'] === (int)$admin->is_super) {
            return true;
        }


        if ($admin->roles->isEmpty()) {
            return false;
        }
        $roleIds = $admin->roles->pluck('id')->toArray();

        $roles = $this->roleRepository->getRoleByIds($roleIds);
        if ($roles->isEmpty()) {
            return false;
        }

        foreach ($roles as $role) {
            if ($role->routes->isEmpty()) {
                continue;
            }
            $route = $role->routes->firstWhere('name', $routeName);
            if ($route) {
                return true;
            }
        }
        return false;
    }
}
