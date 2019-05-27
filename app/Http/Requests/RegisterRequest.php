<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'company' => 'required',
            'represent' => 'required',
            'tel' => 'required|max:11',
            'postcodeA' => 'required|max:3|min:3',
            'postcodeB' => 'required|max:4|min:4',
            'address' => 'required',
            'address_number' => 'required',
            'email' => 'nullable|email|max:45'
        ];
    }
}
