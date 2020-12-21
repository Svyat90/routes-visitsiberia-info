<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventPlacePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_place', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')
                ->references('id')->on('events')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('place_id');
            $table->foreign('place_id')
                ->references('id')->on('places')
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
        Schema::dropIfExists('event_place');
    }
}
