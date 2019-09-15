<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
        $rules = [
            'countries_name' => 'required|max:250|unique:countries',
            'countries_flag' => 'required|image',
            'countries_status'  =>  'required'
        ];


        if ($this->isMethod('PUT')) {

            $rules['countries_name'] = 'required|max:250|unique:countries,countries_name,'. $this->segment(3) .',countries_id';
            $rules['countries_flag'] = 'nullable|image';
        }

        return $rules;
    }
}
