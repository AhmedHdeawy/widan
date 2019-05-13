<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name'          => 'required|max:191',
            'email'         => 'required|email|unique:clients',
            'slug'          => 'max:191|unique:clients',
            'description'   => 'required|min:2',
            'address'       => 'required|min:2',
            'phone'         => 'required|min:6',
            'logo'          => 'required|image',
            'location'      => 'required|min:2',
            'status'        => 'required',
            'user_id'       => 'required|numeric',
            // 'city_id'       => 'required|numeric',
        ];

        if ($this->isMethod('PUT')) {
            $rules['logo'] = 'nullable|image';
            $rules['email']  ='required|email|unique:clients,email,'.$this->id.'id';
            $rules['slug']  ='required|unique:clients,slug,'.$this->id.'id';
        }

        return $rules;
    }
}
