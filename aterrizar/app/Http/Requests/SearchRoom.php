<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRoom extends FormRequest
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
            'city' => 'required|exists:cities,id',
            'capacity' => 'required|gt:0',
            'from' => 'required|date|different:to',
            'to' =>'required|date|after:from',    
            'amenities' => '',
        ];
    }
}