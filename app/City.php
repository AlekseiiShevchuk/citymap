<?php

namespace App;

use App\Contracts\HasCoordinates;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
class City extends Model implements HasCoordinates
{
    protected $fillable = ['name_en', 'population', 'year_of_foundation', 'latitude', 'longitude', 'country_id'];

    protected $appends = ['country'];

    protected $visible = [
        'id',
        'name_en',
        'population',
        'year_of_foundation',
        'latitude',
        'longitude',
        'localized_data',
        'cities_to_go',
        'weight',
        'points',
        'is_possible_to_get',
        'price_by_car',
        'price_by_train',
        'price_by_plane',
        'is_possible_to_get_by_car',
        'is_possible_to_get_by_train',
        'is_possible_to_get_by_plane',
        'possible_cities_to_go',
        'updated_at',
        'country'
    ];

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

    public function getCountryAttribute()
    {
        if ($this->country_object instanceof Country) {
            return $this->country_object->name;
        } else {
            return '';
        }
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
        return $this->belongsToMany(City::class, 'city_city_to_go', 'city_id', 'city_to_go_id')
            ->withPivot([
                'weight',
                'is_possible_to_get',
                'points',
                'price_by_car',
                'price_by_train',
                'price_by_plane',
                'is_possible_to_get_by_car',
                'is_possible_to_get_by_train',
                'is_possible_to_get_by_plane'
            ])->select([
                'id',
                'name_en',
                'weight',
                'is_possible_to_get',
                'price_by_car',
                'price_by_train',
                'price_by_plane',
                'is_possible_to_get_by_car',
                'is_possible_to_get_by_train',
                'is_possible_to_get_by_plane',
                'points',
                'latitude',
                'longitude'
            ]);
    }

    public function possible_cities_to_go()
    {
        return $this->hasMany(CityTransfer::class, 'city_id')->where('is_possible_to_get', 1);
    }

    public function localized_data()
    {
        if (Auth::user() instanceof Player) {
            return $this->hasMany(LocalizedCityDatum::class)->where('language_id', Auth::user()->language_id);
        } else {
            return $this->hasMany(LocalizedCityDatum::class);
        }
    }

    public function getCoordinates(): string
    {
        return $this->latitude . ',' . $this->longitude;
    }

    public function country_object()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * @param array $newCityToGoArray
     */
    public function updateReverseCitiesInfo(array $newCityToGoArray)
    {
        foreach ($newCityToGoArray as $cityId) {
            if (!CityTransfer::where([
                    'city_id' => $cityId,
                    'city_to_go_id' => $this->id
                ])->first() instanceof CityTransfer
            ) {
                $reverseCity = City::find($cityId);
                $reverseCity->cities_to_go()->syncWithoutDetaching([$this->id]);
                $reverseCity->save();
            }
        }

        foreach (CityTransfer::all() as $cityTransfer){
            if(CityTransfer::where(['city_id' => $cityTransfer->city_to_go_id, 'city_to_go_id' => $cityTransfer->city_id])->first() == null){
                $cityTransfer->delete();
            }
        }
    }
}
