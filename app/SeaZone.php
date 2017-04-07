<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SeaZone
 *
 * @package App
 * @property double $start_point_latitude
 * @property double $start_point_longitude
 * @property double $end_point_lalitude
 * @property double $end_point_longitude
 * @property string $city_transfer
*/
class SeaZone extends Model
{
    use SoftDeletes;

    protected $fillable = ['start_point_latitude', 'start_point_longitude', 'end_point_lalitude', 'end_point_longitude', 'city_transfer_id'];
    

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setStartPointLatitudeAttribute($input)
    {
        if ($input != '') {
            $this->attributes['start_point_latitude'] = $input;
        } else {
            $this->attributes['start_point_latitude'] = null;
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setStartPointLongitudeAttribute($input)
    {
        if ($input != '') {
            $this->attributes['start_point_longitude'] = $input;
        } else {
            $this->attributes['start_point_longitude'] = null;
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setEndPointLalitudeAttribute($input)
    {
        if ($input != '') {
            $this->attributes['end_point_lalitude'] = $input;
        } else {
            $this->attributes['end_point_lalitude'] = null;
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setEndPointLongitudeAttribute($input)
    {
        if ($input != '') {
            $this->attributes['end_point_longitude'] = $input;
        } else {
            $this->attributes['end_point_longitude'] = null;
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCityTransferIdAttribute($input)
    {
        $this->attributes['city_transfer_id'] = $input ? $input : null;
    }
    
    public function city_transfer()
    {
        return $this->belongsTo(CityTransfer::class, 'city_transfer_id')->withTrashed();
    }
    
}
