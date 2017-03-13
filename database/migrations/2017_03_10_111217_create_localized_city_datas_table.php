<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalizedCityDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('localized_city_datas')) {
            Schema::create('localized_city_datas', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('city_id')->unsigned()->nullable();
                $table->foreign('city_id', 'fk_21216_city_city_id_localized_city_datum')->references('id')->on('cities')->onDelete('cascade');
                $table->integer('language_id')->unsigned()->nullable();
                $table->foreign('language_id', 'fk_21207_language_language_id_localized_city_datum')->references('id')->on('languages')->onDelete('cascade');
                $table->string('name');
                $table->string('description')->nullable();
                
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
        Schema::dropIfExists('localized_city_datas');
    }
}
