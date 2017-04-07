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
 * @property double $end_point_latitude
 * @property double $end_point_longitude
 * @property string $city_transfer
*/
class SeaZone extends Model
{

    protected $fillable = ['start_point_latitude', 'start_point_longitude', 'end_point_latitude', 'end_point_longitude', 'city_transfer_id'];
    
    public function city_transfer()
    {
        return $this->belongsTo(CityTransfer::class, 'city_transfer_id');
    }
    
}
