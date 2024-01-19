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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->innoDb();
            $table->charset('utf8mb4');
            $table->string('name', 50)->default('')->comment('项目名称');
            $table->text('description')->comment('项目描述');
            $table->integer('admin_id')->default(0)->comment('创建人');
            $table->string(' person_in_charge')->default(0)->comment('负责人');
            $table->string(' project_members')->default(0)->comment('项目成员');
            $table->integer('created_at')->unsigned()->default(null)->comment("创建时间");
            $table->integer('updated_at')->unsigned()->default(null)->comment("修改时间");
            $table->integer('deleted_at')->unsigned()->default(null)->comment("删除时间");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
