<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'categories_name' => 'required|max:250|unique:categories',
            'categories_status'  =>  'required'
        ];


        if ($this->isMethod('PUT')) {

            $rules['categories_name'] = 'required|max:250|unique:categories,categories_name,'. $this->segment(3) .',categories_id';
        }

        return $rules;
    }
}
