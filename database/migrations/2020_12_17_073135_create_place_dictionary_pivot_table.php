<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceDictionaryPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_dictionary', function (Blueprint $table) {
            $table->unsignedBigInteger('place_id');
            $table->foreign('place_id')
                ->references('id')->on('places')
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
        Schema::dropIfExists('attraction_dictionary_pivot');
    }
}
