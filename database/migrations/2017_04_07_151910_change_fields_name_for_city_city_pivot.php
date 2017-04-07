<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldsNameForCityCityPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('city_city_to_go', function (Blueprint $table) {
            $table->renameColumn('price_by_bus','price_by_car');
            $table->renameColumn('is_possible_to_get_by_bus','is_possible_to_get_by_car');
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
