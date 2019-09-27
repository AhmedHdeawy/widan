<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the admin is authorized to make this request.
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
        $rules = [
            
            'email' => 'required|email|max:100|min:2',
            'phone' => 'required|max:100|min:2',
            'city' => 'required|max:100|min:2',
            'building' => 'required|max:100|min:2',
            'unit' => 'required|max:100|min:1',
            'street' => 'required|max:100|min:2',
            'day' => 'required|max:100|min:2',
            'time_from' => 'required|max:100|min:2',
            'time_to' => 'required|max:100|after:time_from',
            'notes' => 'string|nullable',
        ];

        return $rules;
    }
}
