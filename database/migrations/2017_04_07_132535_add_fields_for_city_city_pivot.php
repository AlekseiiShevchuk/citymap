<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsForCityCityPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('city_city_to_go', function (Blueprint $table) {
            $table->increments('id_city_transfer');
            $table->tinyInteger('is_possible_to_get_by_car')->default(0);
            $table->integer('price_by_car')->unsigned()->default(10);
            $table->tinyInteger('is_possible_to_get_by_train')->default(0);
            $table->integer('price_by_train')->unsigned()->default(10);
            $table->tinyInteger('is_possible_to_get_by_plane')->default(0);
            $table->integer('price_by_plane')->unsigned()->default(10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('city_city_to_go', function (Blueprint $table) {
            //
        });
    }
}
