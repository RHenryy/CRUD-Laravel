<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id_member', 3);
            $table->string('nickname', 20);
            $table->string('password', 60);
            $table->string('last name', 20);
            $table->string('first name', 20);
            $table->string('email', 50);
            $table->tinyText('civility', ['m', 'f']);
            $table->integer('status');
            $table->dateTime('register_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
};
