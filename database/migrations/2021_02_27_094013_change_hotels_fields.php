<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeHotelsFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->json('rooms_fund')->nullable();
            $table->unsignedInteger('price')->nullable()->change();
            $table->dropColumn('room_desc', 'food_desc', 'conditions_payment');
        });

        Schema::table('hotels', function (Blueprint $table) {
            $table->enum('conditions_payment', ['cash', 'card'])->default('cash');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('rooms_fund');
        });
    }
}
