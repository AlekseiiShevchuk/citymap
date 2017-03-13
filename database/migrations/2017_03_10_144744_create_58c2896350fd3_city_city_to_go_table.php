<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create58c2896350fd3CityCityToGoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('city_city_to_go')) {
            Schema::create('city_city_to_go', function (Blueprint $table) {
                $table->integer('city_id')->unsigned()->nullable();
                $table->foreign('city_id', 'fk_p_21216_21207_city_to_go_city')->references('id')->on('cities')->onDelete('cascade');
                $table->integer('city_to_go_id')->unsigned()->nullable();
                $table->foreign('city_to_go_id', 'fk_p_21207_21216_city_city_to_go')->references('id')->on('cities')->onDelete('cascade');
                
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
        Schema::dropIfExists('city_city_to_go');
    }
}
