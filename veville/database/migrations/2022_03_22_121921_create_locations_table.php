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
        Schema::create('locations', function (Blueprint $table) {
            $table->id('id_location', 3);
            $table->foreignId('id_agency', 3)->references('id_agency')->on('agencies')->onDelete('cascade');
            $table->string('title_location', 200);
            $table->string('description')->nullable();
            $table->decimal('rent_price', 10, 2);
            $table->string('photo', 200);

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
        Schema::dropIfExists('vehicles');
    }
};
