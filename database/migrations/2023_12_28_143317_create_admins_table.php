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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30)->default('')->comment('用户名称');
            $table->string('email', 100)->default('')->comment('邮箱');
            $table->string('password', 255)->default('')->comment('密码');
            $table->dateTime('last_login_time')->nullable()->comment('最后登录时间');
            $table->string('last_login_ip', 15)->default('')->comment('最后登录IP');
            $table->tinyInteger('status')->default('0')->comment('0正常1禁用');
            $table->tinyInteger('is_super')->default('0')->comment('0普通管理员1超级管理员');
            $table->integer('created_at')->unsigned()->default(null)->comment("创建时间");
            $table->integer('updated_at')->unsigned()->default(null)->comment("修改时间");
        });

        \Illuminate\Support\Facades\DB::table('admins')->insert([
            'name'       => 'admin',
            'email'      => 'admin@qq.com',
            'password'   => \Illuminate\Support\Facades\Hash::make(123456),
            'is_super'   => 1,
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
