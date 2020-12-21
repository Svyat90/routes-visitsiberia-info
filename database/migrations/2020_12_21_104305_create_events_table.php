<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 256)->unique();
            $table->boolean('active')->default(false);
            $table->boolean('recommended')->default(false);
            $table->string('lat', 32);
            $table->string('lng', 32);
            $table->json('location')->nullable();
            $table->json('name')->nullable();
            $table->json('header_desc')->nullable();
            $table->json('page_desc')->nullable();
            $table->json('helpful_info')->nullable();
            $table->json('history_desc')->nullable();
            $table->json('contact_desc')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
