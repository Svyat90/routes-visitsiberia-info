<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewfieldInRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('routes', function (Blueprint $table) {
            $table->dropColumn(
                'features',
                'contacts_representatives',
                'addresses_representatives',
                'phones_representatives',
                'additional_links'
            );

            $table->boolean('walking_route')->default(false);
            $table->boolean('available_for_invalids')->default(false);
            $table->boolean('can_by_car')->default(false);
            $table->boolean('with_children')->default(false);

            $table->json('features_desc')->nullable();
            $table->json('statistic_info_desc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('routes', function (Blueprint $table) {
            $table->dropColumn(
                'walking_route',
                'available_for_invalids',
                'can_by_car',
                'features_desc',
                'contacts_representatives'
            );

            $table->json('features')->nullable();
            $table->json('contacts_representatives')->nullable();
        });
    }
}
