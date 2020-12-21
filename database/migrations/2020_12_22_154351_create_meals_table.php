<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 128)->unique();
            $table->boolean('active')->default(false);
            $table->boolean('recommended')->default(false);
            $table->boolean('have_breakfasts')->default(false);
            $table->boolean('have_business_lunch')->default(false);
            $table->boolean('delivery_available')->default(false);
            $table->string('lat', 32)->nullable();
            $table->string('lng', 32)->nullable();
            $table->json('name')->nullable();
            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();
            $table->json('page_desc')->nullable();
            $table->json('working_hours')->nullable();
            $table->json('location')->nullable();
            $table->json('contact_desc')->nullable();
            $table->json('history_desc')->nullable();
            $table->string('site_link', 512)->nullable();
            $table->string('social_links', 512)->nullable();
            $table->string('phones', 512)->nullable();
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
        Schema::dropIfExists('meals');
    }
}
