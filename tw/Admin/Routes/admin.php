<?php

use Illuminate\Support\Facades\Route;
use Tw\Admin\Http\Controllers\AdminController;
use Tw\Admin\Http\Controllers\CommonController;
use Tw\Admin\Http\Controllers\LoginController;
use Tw\Admin\Http\Controllers\ProjectController;
use Tw\Admin\Http\Controllers\RoleController;
use Tw\Admin\Http\Controllers\RouteController;
use Tw\Admin\Http\Middleware\AuthMiddleware;
use Tw\Admin\Http\Middleware\LangMiddleware;

Route::prefix("backend")->middleware(LangMiddleware::class)->group(function () {
    //登录
    Route::post("login", [LoginController::class, 'index'])->name('admin.login');
    Route::middleware(AuthMiddleware::class)->group(function () {
        //后台管理员用户
        Route::get("admin/index", [AdminController::class, 'index'])->name('admin.index');
        Route::post("admin/create", [AdminController::class, 'store'])->name('admin.create');
        Route::get("admin/edit/{id}", [AdminController::class, 'show'])->name('admin.edit');
        Route::put("admin/update/{id}", [AdminController::class, 'update'])->name('admin.update');
        Route::delete("admin/delete/{id}", [AdminController::class, 'destroy'])->name('admin.delete');

        //角色管理
        Route::get("role/index", [RoleController::class, 'index'])->name('role.index');
        Route::post("role/create", [RoleController::class, 'store'])->name('role.create');
        Route::get("role/edit/{id}", [RoleController::class, 'show'])->name('role.edit');
        Route::put("role/update/{id}", [RoleController::class, 'update'])->name('role.update');
        Route::delete("role/delete/{id}", [RoleController::class, 'destroy'])->name('role.delete');

        //路由管理
        Route::get("route/index", [RouteController::class, 'index'])->name('role.index');
        Route::post("route/create", [RouteController::class, 'store'])->name('role.create');
        Route::get("route/edit/{id}", [RouteController::class, 'show'])->name('role.edit');
        Route::put("route/update/{id}", [RouteController::class, 'update'])->name('role.update');
        Route::delete("route/delete/{id}", [RouteController::class, 'destroy'])->name('role.delete');

        //项目管理
        Route::get("/project/index", [ProjectController::class, 'index'])->name('project.index');
        Route::post("/project/create", [ProjectController::class, 'store'])->name('project.create');

        //公共路由
        Route::prefix("common")->group(function () {
            Route::get("getTreeRoute", [CommonController::class, 'getTreeRoute'])->name('common.get-tree-route');
            Route::get("getRoleAll", [CommonController::class, 'getRoleAll'])->name('common.get-role-all');
            Route::get('getCurrentLoginUserInfo', [CommonController::class, 'getCurrentLoginUserInfo'])
                 ->name('common.get-current-login-user-info');

            Route::get('menus', [CommonController::class, 'getCurrentUserMenus'])
                 ->name('common.menus');

            Route::post("updateCurrentAdmin", [CommonController::class, 'updateCurrentAdmin'])
                 ->name('common.update-current-admin');

        });

    });
});
