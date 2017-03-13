<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LocalizedCityDatum
 *
 * @package App
 * @property string $city
 * @property string $language
 * @property string $name
 * @property string $description
*/
class LocalizedCityDatum extends Model
{
    protected $table = 'localized_city_datas';
    protected $fillable = ['name', 'description', 'city_id', 'language_id'];
    protected $visible = ['name','description', 'language'];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCityIdAttribute($input)
    {
        $this->attributes['city_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setLanguageIdAttribute($input)
    {
        $this->attributes['language_id'] = $input ? $input : null;
    }
    
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
    
}
