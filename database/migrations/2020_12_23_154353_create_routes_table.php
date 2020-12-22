<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 128)->unique();
            $table->boolean('active')->default(false);
            $table->boolean('recommended')->default(false);
            $table->json('name')->nullable();
            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();
            $table->json('life_hacks')->nullable();
            $table->json('page_desc')->nullable();
            $table->json('header_desc')->nullable();
            $table->json('location')->nullable();
            $table->json('contact_desc')->nullable();
            $table->json('history_desc')->nullable();
            $table->json('features')->nullable();
            $table->json('static_info')->nullable();
            $table->json('duration')->nullable();
            $table->json('list_points')->nullable();
            $table->json('what_take')->nullable();
            $table->json('addresses_representatives')->nullable();
            $table->json('phones_representatives')->nullable();
            $table->json('more_info')->nullable();
            $table->json('additional_links')->nullable();
            $table->string('site_link', 512)->nullable();
            $table->string('email', 512)->nullable();
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
        Schema::dropIfExists('routes');
    }
}
