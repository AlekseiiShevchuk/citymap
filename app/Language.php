<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Language
 *
 * @package App
 * @property string $abbreviation
 * @property string $name
 * @property tinyInteger $is_active_for_admin
 * @property tinyInteger $is_active_for_users
 */
class Language extends Model
{
    protected $fillable = ['abbreviation', 'name', 'is_active_for_admin', 'is_active_for_users'];
    protected $visible = ['id', 'abbreviation', 'name'];
}
