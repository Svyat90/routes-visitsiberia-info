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
            $table->boolean('have_camping')->default(false);
            $table->string('lat', 32)->nullable();
            $table->string('lng', 32)->nullable();
            $table->json('name')->nullable();
            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();
            $table->json('life_hacks')->nullable();
            $table->json('page_desc')->nullable();
            $table->json('location')->nullable();
            $table->json('contact_desc')->nullable();
            $table->json('history_desc')->nullable();
            $table->string('site_link', 512)->nullable();
            $table->string('additional_links')->nullable();
            $table->json('addresses_representatives')->nullable();
            $table->json('phones_representatives')->nullable();
            $table->timestamp('date_from')->useCurrent();
            $table->timestamp('date_to')->useCurrent();
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
