<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_fields', function (Blueprint $table) {
            $table->id();
            $table->string('url', 1024)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('field', 64);
            $table->enum('type', ['site', 'phone', 'vk', 'viber', 'whatsapp', 'telegram', 'email']);
            $table->morphs('sociable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_fields');
    }
}
