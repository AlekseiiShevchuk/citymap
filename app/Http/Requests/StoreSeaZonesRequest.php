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
            'start_point_latitude' => 'max:9|required',
            'start_point_longitude' => 'max:9|required',
            'end_point_latitude' => 'max:9|required',
            'end_point_longitude' => 'max:9|required',
            'city_transfer_id' => 'required',
        ];
    }
}
