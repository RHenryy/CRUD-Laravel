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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id_order', 3);
            $table->foreignId('id_member', 3)->references('id_member')->on('members')->onDelete('cascade');
            $table->foreignId('id_vehicle', 3)->references('id_vehicle')->on('vehicles')->onDelete('cascade');
            $table->foreignId('id_agency', 3)->references('id_agency')->on('agencies')->onDelete('cascade');
            $table->dateTime('begin_date_time');
            $table->dateTime('end_date_time');
            $table->integer('Total Price');
            $table->dateTime('register_date');
            $table->dateTime('updated_at');
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
