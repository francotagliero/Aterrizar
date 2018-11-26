<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFlight extends FormRequest
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
            'to' => 'required|different:from|exists:cities,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'duration' => 'required|date_format:H:i',
            'price' => 'required',
            'economy_seats' => 'required',
            'business_seats' => 'required',
            'first_class_seats' => 'required'
        ];
    }
}
