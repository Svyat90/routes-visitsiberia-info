<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealDictionaryPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_dictionary', function (Blueprint $table) {
            $table->unsignedBigInteger('meal_id');
            $table->foreign('meal_id')
                ->references('id')->on('meals')
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
        Schema::dropIfExists('meal_dictionary');
    }
}
