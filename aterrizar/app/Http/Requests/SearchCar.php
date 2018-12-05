<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchCar extends FormRequest
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
            'from' => 'required|different:to|exists:cities,id',
            'to' => 'required|exists:cities,id',
            'date_rent' => 'required|date|different:date_return',
            'date_return' =>'required|date'    
            'brand' => 'required|exists:car_brands,id',
            'agency' => 'required|exists:car_rental_agencies,id'
        ];
    }
}