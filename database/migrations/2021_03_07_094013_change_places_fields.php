<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePlacesFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('places', function (Blueprint $table) {
            $table->boolean('with_children')->default(false);
            $table->dropColumn('header_desc', 'social_links', 'additional_links', 'contacts_representatives', 'contacts_delivery', 'recommended');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('places', function (Blueprint $table) {
            $table->dropColumn('with_children')->nullable();
            $table->string('header_desc')->nullable();
            $table->string('social_links')->nullable();
            $table->string('additional_links')->nullable();
            $table->string('contacts_representatives')->nullable();
            $table->string('contacts_delivery')->nullable();
        });
    }
}
