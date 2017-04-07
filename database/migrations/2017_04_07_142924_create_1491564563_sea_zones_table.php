<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1491564563SeaZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('sea_zones')) {
            Schema::create('sea_zones', function (Blueprint $table) {
                $table->increments('id');
                $table->double('start_point_latitude', 8, 5)->nullable();
                $table->double('start_point_longitude', 8, 5)->nullable();
                $table->double('end_point_latitude', 8, 5)->nullable();
                $table->double('end_point_longitude', 8, 5)->nullable();
                $table->integer('city_transfer_id')->unsigned()->nullable();
                $table->foreign('city_transfer_id', 'fk_28033_citytransfer_city_transfer_id_sea_zone')->references('id_city_transfer')->on('city_city_to_go')->onDelete('cascade');
                
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sea_zones');
    }
}
