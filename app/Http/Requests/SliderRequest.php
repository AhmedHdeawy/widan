<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use APP\Models\Language;

class SliderRequest extends FormRequest
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
            'sliders_status'  =>  'required',
            'sliders_img'  =>  'required|image'
        ];

        $languages = Language::active()->get();

        foreach ($languages as $languag) {

            $rules[ $languag->locale. '.sliders_title' ] = 'required|max:250';
            $rules[ $languag->locale. '.sliders_desc' ] = 'required';
        }

        if ($this->isMethod('PUT')) {
            $rules['sliders_img']  =  'nullable|image';
        }

        return $rules;
    }
}
