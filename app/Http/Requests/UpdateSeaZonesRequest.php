<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSeaZonesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'start_point_latitude' => 'max:8|required',
            'start_point_longitude' => 'max:8|required',
            'end_point_lalitude' => 'max:8|required',
            'end_point_longitude' => 'max:8',
            'city_transfer_id' => 'required',
        ];
    }
}
