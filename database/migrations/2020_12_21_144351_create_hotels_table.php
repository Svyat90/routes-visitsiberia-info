<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 128)->unique();
            $table->boolean('active')->default(false);
            $table->boolean('recommended')->default(false);
            $table->json('name')->nullable();
            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();
            $table->json('conditions_accommodation')->nullable();
            $table->json('description')->nullable();
            $table->json('conditions_payment')->nullable();
            $table->json('room_desc')->nullable();
            $table->json('additional_services')->nullable();
            $table->json('food_desc')->nullable();
            $table->json('contact_desc')->nullable();
            $table->json('price')->nullable();
            $table->string('site_link', 512)->nullable();
            $table->string('social_links', 512)->nullable();
            $table->string('aggregator_links', 512)->nullable();
            $table->string('phones', 512)->nullable();
            $table->json('location')->nullable();
            $table->string('lat', 32)->nullable();
            $table->string('lng', 32)->nullable();
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
        Schema::dropIfExists('hotels');
    }
}
