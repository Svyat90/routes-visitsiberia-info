<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('places', function (Blueprint $table) {
            $table->dropColumn('helpful_info');
            $table->json('life_hacks')->nullable();
            $table->string('site_link', 512)->nullable();
            $table->string('social_links', 512)->nullable();
            $table->string('contacts_representatives', 512)->nullable();
            $table->string('additional_links', 512)->nullable();
            $table->string('contacts_delivery', 512)->nullable();
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
            $table->dropColumn(
                'life_hacks',
                'site_link',
                'social_links',
                'contacts_representatives',
                'additional_links',
                'contacts_delivery',
            );
        });
    }
}
