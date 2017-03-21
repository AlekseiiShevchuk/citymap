<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Player
 *
 * @package App
 * @property string $nickname
 * @property string $language
 */
class Player extends Authenticatable
{
    protected $fillable = ['nickname', 'language_id', 'avatar'];


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

}
