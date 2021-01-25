<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('rating')->nullable();
            $table->string('name', 256)->nullable();
            $table->string('phone', 256)->nullable();
            $table->string('email', 256)->nullable();
            $table->text('body')->nullable();
            $table->boolean('approved')->default(false);
            $table->boolean('allow_comments')->default(true);
            $table->morphs('reviewrateable');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
