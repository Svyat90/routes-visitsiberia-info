<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventDictionaryPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_dictionary', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')
                ->references('id')->on('events')
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
        Schema::dropIfExists('event_dictionary');
    }
}
