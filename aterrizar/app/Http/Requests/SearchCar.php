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
            'from' => 'required|exists:cities,id',
            'to' => 'required|exists:cities,id',
            'date_rent' => 'required|date|different:date_return',
            'date_return' =>'required|date|after:date_rent',    
            'agency' => 'required|exists:car_rental_agencies,id'
        ];
    }
}