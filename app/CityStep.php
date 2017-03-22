<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class CityStep
 *
 * @package App
 * @property string $by_player
 * @property string $to_city
*/
class CityStep extends Model
{
    protected $fillable = ['by_player_id', 'to_city_id'];

    protected $hidden = ['updated_at'];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setByPlayerIdAttribute($input)
    {
        $this->attributes['by_player_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setToCityIdAttribute($input)
    {
        $this->attributes['to_city_id'] = $input ? $input : null;
    }
    
    public function by_player()
    {
        return $this->belongsTo(Player::class, 'by_player_id');
    }
    
    public function to_city()
    {
        return $this->belongsTo(City::class, 'to_city_id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('sort_by_created_date', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }
    
}
