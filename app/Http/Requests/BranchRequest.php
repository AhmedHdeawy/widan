<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
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
            'price'         => 'numeric',
            'description'   => 'required|min:2',
            'details'       => 'required|min:2',
            'currency'      => '',
            'status'        => 'required',
            'branch_id'       => 'required|numeric',
        ];


        return $rules;
    }
}
