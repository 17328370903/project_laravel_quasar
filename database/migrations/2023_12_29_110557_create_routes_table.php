<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->integer('pid')->unsigned()->default(0)->comment("父级id");
            $table->integer('weight')->default(0)->comment("权重");
            $table->string('name', 100)->default('')->comment("前端路由名称");
            $table->string('path', 100)->default('')->comment("前端路由");
            $table->string('component', 100)->default('')->comment("前端组件");
            $table->string('icon', 100)->default('')->comment("图标");
            $table->string('active_path', 100)->default('')->comment("前端选择路由");
            $table->string('redirect', 100)->default('')->comment("重定向");
            $table->tinyInteger('is_hidden')->default(0)->comment("0显示1隐藏");


            $table->string('title', 100)->default('')->comment("标题");
            $table->string('method', 100)->default('GET')->comment("请求方式");
            $table->string('api', 100)->default('')->comment("后端api路由");
            $table->integer('created_at')->unsigned()->default(null)->comment("创建时间");
            $table->integer('updated_at')->unsigned()->default(null)->comment("修改时间");
            $table->integer('deleted_at')->unsigned()->default(null)->comment("删除时间");
        });

        Schema::create('role_route_rel', function (Blueprint $table) {
            $table->integer('role_id')->unsigned()->default(0)->comment("角色id");
            $table->integer('route_id')->unsigned()->default(0)->comment("路由id");
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
        Schema::dropIfExists('role_route_rel');
    }
};
