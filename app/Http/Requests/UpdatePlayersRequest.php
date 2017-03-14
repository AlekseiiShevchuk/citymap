<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlayersRequest extends FormRequest
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
            
            'device_id' => 'required|unique:players,device_id,'.$this->route('player'),
            'nickname' => 'required',
            'language_id' => 'required',
        ];
    }
}
