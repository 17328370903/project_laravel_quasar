<?php

namespace Tw\Admin\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Tw\Admin\Repositories\AdminRepository;
use Tw\Admin\Repositories\interface\AdminRepositoryInterface;
use Tw\Admin\Repositories\interface\ProjectRepositoryInterface;
use Tw\Admin\Repositories\interface\RoleRepositoryInterface;
use Tw\Admin\Repositories\interface\RouteRepositoryInterface;
use Tw\Admin\Repositories\ProjectRepository;
use Tw\Admin\Repositories\RoleRepository;
use Tw\Admin\Repositories\RouteRepository;

class AdminServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        //加載路由文件
        $this->loadRoutesFrom(__DIR__ . "/../Routes/admin.php");

        //加載配置文件
        $this->mergeConfigFrom(__DIR__ . "/../Config/admin.php", "admin");

        //数据库版本太低
        Schema::defaultStringLength(191);

        $this->bindServices();


    }


    /**
     * 绑定服务
     * @return void
     */
    protected function bindServices(): void
    {
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(RouteRepositoryInterface::class, RouteRepository::class);
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
    }

}
