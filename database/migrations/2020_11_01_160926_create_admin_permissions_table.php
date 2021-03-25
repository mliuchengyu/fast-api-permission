<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAdminPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_permissions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->integer('parent_id')->default(0);;
            $table->string('name',60)->index();
            $table->string('slug',60)->unique();
            $table->string('description')->default('system init');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `admin_permissions` comment '系统-权限'"); //表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_permissions');
    }
}
