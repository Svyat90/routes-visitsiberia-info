<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\Event;
use \App\Models\Place;
use \App\Models\Hotel;
use \App\Models\Meal;
use \App\Models\Route;

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
            $table->json('city')->after('location')->nullable();
        });

        Schema::table('hotels', function (Blueprint $table) {
            $table->json('city')->after('location')->nullable();
        });

        Schema::table('meals', function (Blueprint $table) {
            $table->json('city')->after('location')->nullable();
        });

        Schema::table('places', function (Blueprint $table) {
            $table->json('city')->after('location')->nullable();
        });

        Schema::table('routes', function (Blueprint $table) {
            $table->json('city')->after('location')->nullable();
        });

        $this->setDefaultValues();
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

    private function setDefaultValues() : void
    {
        $defaultData = ['en' => '', 'ru' => ''];

        Event::all()
            ->each(function (Event $event) use ($defaultData) {
                $event->city = $defaultData;
                $event->save();
            });

        Place ::all()
            ->each(function (Place $place) use ($defaultData) {
                $place->city = $defaultData;
                $place->save();
            });

        Hotel ::all()
            ->each(function (Hotel $hotel) use ($defaultData) {
                $hotel->city = $defaultData;
                $hotel->save();
            });

        Meal ::all()
            ->each(function (Meal $meal) use ($defaultData) {
                $meal->city = $defaultData;
                $meal->save();
            });

        Route::all()
            ->each(function (Route $route) use ($defaultData) {
                $route->city = $defaultData;
                $route->save();
            });
    }
}
