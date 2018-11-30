<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCar extends FormRequest
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
            'brand' => 'required|exists:car_brands,id',
            'agency' => 'required|exists:car_rental_agencies,id',
            'model' => 'required',
            'segment' => 'required|size:1',
            'price' => 'required|numeric',
            'range' => 'required|integer'
        ];
    }
}
