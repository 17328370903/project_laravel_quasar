<?php

namespace Tw\Admin\Http\Controllers;

use Tw\Admin\Http\Requests\AdminRequest;
use Tw\Admin\Repositories\interface\AdminRepositoryInterface;
use Tw\Admin\Repositories\interface\RoleRepositoryInterface;
use Tw\Admin\Repositories\interface\RouteRepositoryInterface;

class CommonController extends Controller
{

    public function __construct(
        protected RouteRepositoryInterface $routeRepository,
        protected RoleRepositoryInterface  $roleRepository,
        protected AdminRepositoryInterface $adminRepository
    )
    {
    }

    /**
     * 获取树形路由
     * @return array
     */
    public function getTreeRoute()
    {
        $field = ['id', 'pid', 'title', 'path', 'name', 'component', 'icon', 'redirect', 'is_hidden', 'active_path'];
        return json_success($this->routeRepository->getTreeRoute($field));
    }

    /**
     * 获取所有角色
     */
    public function getRoleAll()
    {
        return json_success($this->roleRepository->getRoleAll(['id', 'name', 'status']));
    }

    /**
     * 获取当前登录用户信息
     * @return array
     */
    public function getCurrentLoginUserInfo()
    {
        return json_success(request()->admin);
    }

    /**
     * 获取当前登录用的菜单权限
     * @return array
     */
    public function getCurrentUserMenus(): array
    {
        $admin  = request()->admin;
        $roles  = $this->roleRepository->getRoleByIds($admin->roles->pluck('id')->toArray());
        $routes = [];
        foreach ($roles as $role) {
            $routes = [...$routes, ...$role->routes->toArray()];
        }

        $newRoutes = [];
        foreach ($routes as $route) {
            $newRoutes[$route['pid']][] = $route;
        }


        return json_success(getTree($newRoutes));
    }

    /**
     * 修改当前登录用户信息
     * @param AdminRequest $request
     * @return array
     */
    public function updateCurrentAdmin(AdminRequest $request)
    {
        $this->adminRepository->update(request()->admin->id, $request->validated());
        return json_success(trans('common.update-success'));
    }

}
