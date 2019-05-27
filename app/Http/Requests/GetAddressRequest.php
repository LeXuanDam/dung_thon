<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetAddressRequest extends FormRequest
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
            'postcodeA' => 'required|max:3|min:3',
            'postcodeB' => 'required|max:4|min:4',
        ];
    }
}
