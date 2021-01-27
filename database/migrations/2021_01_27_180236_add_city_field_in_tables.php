<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCityFieldInTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->json('city')->before('location')->nullable();
        });

        Schema::table('hotels', function (Blueprint $table) {
            $table->json('city')->before('location')->nullable();
        });

        Schema::table('meals', function (Blueprint $table) {
            $table->json('city')->before('location')->nullable();
        });

        Schema::table('places', function (Blueprint $table) {
            $table->json('city')->before('location')->nullable();
        });

        Schema::table('routes', function (Blueprint $table) {
            $table->json('city')->before('location')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('city');
        });

        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('city');
        });

        Schema::table('meals', function (Blueprint $table) {
            $table->dropColumn('city');
        });

        Schema::table('places', function (Blueprint $table) {
            $table->dropColumn('city');
        });

        Schema::table('routes', function (Blueprint $table) {
            $table->dropColumn('city');
        });
    }
}
