<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateRepliesTable extends Migration
{
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('review_id');
            $table->string('name', 256)->nullable();
            $table->string('phone', 256)->nullable();
            $table->string('email', 256)->nullable();
            $table->text('body')->nullable();
            $table->boolean('approved')->default(false);
            $table->boolean('is_admin')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('replies');
    }
}
