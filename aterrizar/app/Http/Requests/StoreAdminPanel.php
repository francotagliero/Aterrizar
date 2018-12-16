<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminPanel extends FormRequest
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
            'max_flight_duration' => 'required|numeric|min:0',
            'percentage_stopover' => 'required|numeric|min:0|max:100',
            'max_gap' => 'required|numeric|min:0',
            'return_tax' => 'required|numeric|min:0|max:100',
            'points_per_peso' => 'required|numeric|min:0',
            'pesos_per_point' => 'required|numeric|min:0',
            'firstclass_factor' => 'required|numeric|min:0|max:100',
            'bussinessclass_factor' => 'required|numeric|min:0|max:100'
        ];
    }
}
