<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_emails', function (Blueprint $table) {
            $table->increments('id')->comment('戳記id');
            $table->integer('user_id')->comment('會員id');
            $table->string('email', 100)->comment('會員email');
            $table->timestamps();

            DB::statement("會員郵件表");//表註釋
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_emails');
    }
}
