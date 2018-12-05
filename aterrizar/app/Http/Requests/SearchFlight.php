<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchFlight extends FormRequest
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
            'date' => 'required|date',
            'class' => 'required|in:Economy,Business,First',
            'seats' => 'integer|required|min:1'
        ];
    }
}
