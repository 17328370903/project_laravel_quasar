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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->default('')->comment("角色名称");
            $table->tinyInteger('status')->default(0)->comment('0正常1禁用');
            $table->integer('created_at')->unsigned()->default(null)->comment("创建时间");
            $table->integer('updated_at')->unsigned()->default(null)->comment("修改时间");
            $table->innoDb();
            $table->charset('utf8mb4');
            $table->comment("角色表");
        });

        Schema::create('admin_role_rel', function (Blueprint $table) {
            $table->integer("admin_id")->unsigned()->default(0)->comment("管理员id");
            $table->integer("role_id")->unsigned()->default(0)->comment("角色id");
            $table->innoDb();
            $table->charset('utf8mb4');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('admin_role_rel');
    }
};
