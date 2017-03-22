<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Player
 *
 * @package App
 * @property string $nickname
 * @property string $language
 * @property string $avatar
 */
class Player extends Authenticatable
{
    protected $fillable = ['nickname', 'language_id', 'avatar'];

    //need to add property to JSON
    protected $appends = ['currentCity'];

    public function getCurrentCityAttribute()
    {
        $lastCityStep = $this->hasMany(CityStep::class, 'by_player_id')->take(1)->first();

        if ($lastCityStep instanceof CityStep){
            return City::find($lastCityStep->to_city_id);
        }
    }


    /**
     * Set to null if empty
     * @param $input
     */
    public function setLanguageIdAttribute($input)
    {
        $this->attributes['language_id'] = $input ? $input : null;
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function city_steps()
    {
        return $this->hasMany(CityStep::class, 'by_player_id')->take(10);
    }

    public function all_city_steps()
    {
        return $this->hasMany(CityStep::class, 'by_player_id');
    }

}
