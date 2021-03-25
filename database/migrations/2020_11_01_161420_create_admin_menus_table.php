<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAdminMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_menus', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->integer('parent_id')->default(0);
            $table->string('title',100);
            $table->string('path',100)->unique();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `admin_menus` comment '系统-菜单'"); //表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_menus');
    }
}
