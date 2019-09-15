<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use APP\Models\Language;

class BlogRequest extends FormRequest
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
            'blogs_status'  =>  'required',
            'blogs_logo'  =>  'required|image',
            'ar.blogs_title' => 'max:250',
            'ar.blogs_desc' => '',
            'en.blogs_title' => 'max:250',
            'en.blogs_desc' => '',
        ];

        $languages = Language::active()->get();

        // foreach ($languages as $languag) {

        //     $rules[ $languag->locale. '.blogs_title' ] = 'required|max:250';
        //     $rules[ $languag->locale. '.blogs_desc' ] = 'required';
        // }

        if ($this->isMethod('PUT')) {
            $rules['blogs_logo']  =  'nullable|image';
        }

        return $rules;
    }
}
