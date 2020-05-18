<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('avatar', 100)->nullable();
            $table->string('name', 50)->default('');
            $table->string('nickname', 50)->default('');
            $table->string('account', 30)->default('');
            $table->string('password', 500)->default('');
            $table->string('email', 50)->default('');
            $table->string('phone', 50)->default('');
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
        Schema::dropIfExists('admin_members');
    }
}
