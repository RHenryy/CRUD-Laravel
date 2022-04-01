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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id_vehicle', 3);
            $table->foreignId('id_agency', 3)->references('id_agency')->on('agencies')->onDelete('cascade');
            $table->string('title', 200);
            $table->string('brand', 50);
            $table->string('model', 50);
            $table->text('description');
            $table->string('photo', 200);
            $table->decimal('daily_price', 10, 2);
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
        Schema::dropIfExists('vehicles');
    }
};
