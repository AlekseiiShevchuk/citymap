<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCitiesRequest extends FormRequest
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
            
            'name_en' => 'required|unique:cities,name_en,'.$this->route('city'),
            
            
            'latitude' => 'required',
            'longitude' => 'required',
            'cities_to_go.*' => 'exists:languages,id',
        ];
    }
}
