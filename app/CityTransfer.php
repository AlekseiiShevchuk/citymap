<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityTransfer extends Model
{
    protected $primaryKey = 'id_city_transfer';
    protected $table = 'city_city_to_go';
    public $timestamps = false;

    public function synchronizeSettings(CityTransfer $cityTransfer)
    {
        $this->price_by_car = $cityTransfer->price_by_car;
        $this->price_by_train = $cityTransfer->price_by_train;
        $this->price_by_plane = $cityTransfer->price_by_plane;

        $this->is_possible_to_get_by_car = $cityTransfer->is_possible_to_get_by_car;
        $this->is_possible_to_get_by_train = $cityTransfer->is_possible_to_get_by_train;
        $this->is_possible_to_get_by_plane = $cityTransfer->is_possible_to_get_by_plane;

        $this->save();
    }
}
