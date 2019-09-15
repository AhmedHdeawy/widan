<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use APP\Models\Language;

class ServiceRequest extends FormRequest
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
            'services_status'  =>  'required',
            'services_logo'  =>  'required|image'
        ];

        $languages = Language::active()->get();

        foreach ($languages as $languag) {

            $rules[ $languag->locale. '.services_title' ] = 'required|max:250';
            $rules[ $languag->locale. '.services_desc' ] = 'required';
        }

        if ($this->isMethod('PUT')) {
            $rules['services_logo']  =  'nullable|image';
        }

        return $rules;
    }
}
