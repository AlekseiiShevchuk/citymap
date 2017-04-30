<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityTransfer extends Model
{
    const GET_BY_CAR = 1;
    const GET_BY_TRAIN = 2;
    const GET_BY_PLAIN = 3;
    
    protected $primaryKey = 'id_city_transfer';
    protected $table = 'city_city_to_go';
    public $timestamps = false;

    protected $hidden = ['city_id', 'city_to_go_id'];

    //need to add property to JSON
    protected $appends = ['name_en', 'id'];

    public function getNameEnAttribute()
    {
        return City::find($this->city_to_go_id)->name_en;
    }

    public function getIdAttribute()
    {
        return $this->city_to_go_id;
    }

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

    public function sea_zones()
    {
        return $this->hasMany(SeaZone::class,'city_transfer_id');
    }
}
