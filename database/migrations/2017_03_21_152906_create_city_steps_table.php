<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('city_steps')) {
            Schema::create('city_steps', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('by_player_id')->unsigned()->nullable();
                $table->foreign('by_player_id', 'fk_22224_player_by_player_id_city_step')->references('id')->on('players')->onDelete('cascade');
                $table->integer('to_city_id')->unsigned()->nullable();
                $table->foreign('to_city_id', 'fk_21216_city_to_city_id_city_step')->references('id')->on('cities')->onDelete('cascade');
                
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
        Schema::dropIfExists('city_steps');
    }
}
