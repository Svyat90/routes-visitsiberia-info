<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelDictionaryPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_dictionary', function (Blueprint $table) {
            $table->unsignedBigInteger('hotel_id');
            $table->foreign('hotel_id')
                ->references('id')->on('hotels')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('dictionary_id');
            $table->foreign('dictionary_id')
                ->references('id')->on('dictionaries')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_dictionary');
    }
}
