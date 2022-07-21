<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
            
            //
        'brand' =>'required|string|min:4|max:255',
        'vin_code'=>'required|string|max:17|size:17',
        'license_plate'=>'required|string|min:8|max:8|size:8',
        'problem'=>'nullable|string|max:250'
        ];
    }
}
