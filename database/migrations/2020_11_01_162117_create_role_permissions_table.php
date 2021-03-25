<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_role_permissions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('role_id');
            $table->integer('permission_id');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `admin_role_permissions` comment '系统-角色-权限'"); //表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_role_permissions');
    }
}
