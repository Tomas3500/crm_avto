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
            'brand' => 'required|string|max:255',
            'vin_code' => 'required|string|max:17',
            'license_plate' => 'required|string|max:8|',
            'problem' => 'nullable|string|max:255',
            'image' => 'nullable|max:2000',
            'clint_id' => 'required|integer|exists:clints,id',
        ];
    }
}
