<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 *
 * @package App
 * @property string $name_en
 * @property integer $population
 * @property integer $year_of_foundation
 * @property double $latitude
 * @property double $longitude
*/
class City extends Model
{
    protected $fillable = ['name_en', 'population', 'year_of_foundation', 'latitude', 'longitude'];

    protected $visible = ['id','name_en', 'population', 'year_of_foundation', 'latitude', 'longitude','localized_data','cities_to_go','weight','is_possible_to_get','possible_cities_to_go'];
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPopulationAttribute($input)
    {
        $this->attributes['population'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setYearOfFoundationAttribute($input)
    {
        $this->attributes['year_of_foundation'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setLatitudeAttribute($input)
    {
        if ($input != '') {
            $this->attributes['latitude'] = $input;
        } else {
            $this->attributes['latitude'] = null;
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setLongitudeAttribute($input)
    {
        if ($input != '') {
            $this->attributes['longitude'] = $input;
        } else {
            $this->attributes['longitude'] = null;
        }
    }
    
    public function cities_to_go()
    {
        return $this->belongsToMany(City::class, 'city_city_to_go', 'city_id','city_to_go_id')
            ->withPivot(['weight','is_possible_to_get'])->select(['id','weight','is_possible_to_get']);
    }

    public function possible_cities_to_go()
    {
        return $this->belongsToMany(City::class, 'city_city_to_go', 'city_id','city_to_go_id')
            ->withPivot(['weight','is_possible_to_get'])->wherePivot('is_possible_to_get',1)->select(['id','weight','is_possible_to_get']);
    }

    public function localized_data()
    {
        return $this->hasMany(LocalizedCityDatum::class);
    }
    
}
