<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Checkout extends FormRequest
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
            'final' => [
                'required',
                'regex:/^\d{1,3}(\.\d{3})*,\d{2}?$/'
            ],
            'discount' => [
                'required',
                'regex:/^\d{1,3}(\.\d{3})*,\d{2}?$/'
            ],
            'total' => [
                'required',
                'regex:/^\d{1,3}(\.\d{3})*,\d{2}?$/'
            ],
            'points' => 'required|numeric|min:0'
        ];
    }
}
