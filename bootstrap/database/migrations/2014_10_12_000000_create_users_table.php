<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partfinders_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password')->deafult('Australia2020@');
            $table->string('full_name');
            $table->string('email');
            $table->string('mobile_no');
            $table->enum('user_type', array('Admin','Supplier','User'))->default('User');
            $table->enum('status', array('Active','Inactive','Deleted'))->default('Active');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partfinders_users');
    }
}
