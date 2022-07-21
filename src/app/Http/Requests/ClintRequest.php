<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClintRequest extends FormRequest
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
            'name'=>'required|string|min:4|max:20',
            'phone_number'=>'required|string|max:11'
        ];
    }

    public function messages()
    {

        return[
            'name.required'=> 'please enter name',
            'phone_number.required'=> 'please enter phone number'
        ];
    }
}
