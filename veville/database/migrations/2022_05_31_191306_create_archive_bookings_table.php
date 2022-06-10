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
        Schema::create('archive_bookings', function (Blueprint $table) {
            $table->id('id_booking');
            $table->foreignId('id_agent')->references('id_agent')->on('agents')->onDelete('cascade');
            $table->foreignId('id_agency')->references('id_agency')->on('agencies')->onDelete('cascade');
            $table->foreignId('id_location')->references('id_location')->on('locations')->onDelete('cascade');
            $table->foreignId('id_user')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('archive_bookings');
    }
};
