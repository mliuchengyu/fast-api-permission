<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('username',30)->unique();
            $table->string('password',60);
            $table->string('name',30)->comment('姓名');
            $table->string('mobile',20)->comment('手机号')->nullable();
            $table->string('remark')->comment('备注')->nullable();
            $table->string('avatar')->comment('头像')->nullable();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `admin_users` comment '系统-用户'"); //表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_users');
    }
}
