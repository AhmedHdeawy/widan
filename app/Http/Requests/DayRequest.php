<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DayRequest extends FormRequest
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
            'day' => 'required|date',
            'time_from' => 'required',
            'time_to' => 'required|after:time_from',
        ];

        return $rules;
    }
}
