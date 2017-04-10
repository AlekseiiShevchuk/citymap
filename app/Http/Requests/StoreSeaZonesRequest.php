<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSeaZonesRequest extends FormRequest
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
            'start_point_latitude' => 'max:8|required|regex:/^\d*\.{0,1}\d*$/',
            'start_point_longitude' => 'max:8|required|regex:/^\d*\.{0,1}\d*$/',
            'end_point_latitude' => 'max:8|required|regex:/^\d*\.{0,1}\d*$/',
            'end_point_longitude' => 'max:8|regex:/^\d*\.{0,1}\d*$/',
            'city_transfer_id' => 'required',
        ];
    }
}
