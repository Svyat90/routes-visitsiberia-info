<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeMealsFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meals', function (Blueprint $table) {
            $table->text('description')->after('name')->nullable();
            $table->dropColumn(
               'page_desc', 'cost', 'contact_desc', 'history_desc', 'social_links', 'aggregator_links', 'phones'
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meals', function (Blueprint $table) {
            $table->dropColumn('description')->nullable();
            $table->string('page_desc')->nullable();
            $table->string('cost')->nullable();
            $table->string('contact_desc')->nullable();
            $table->string('history_desc')->nullable();
            $table->string('social_links')->nullable();
            $table->string('aggregator_links')->nullable();
            $table->string('phones')->nullable();
        });
    }
}
