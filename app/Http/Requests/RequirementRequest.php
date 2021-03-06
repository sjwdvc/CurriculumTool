<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class RequirementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
             'name' => 'required|min:1|max:255|unique:requirements,name,'.request('id'),
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            '*.required' => 'Het :attribute veld is verplicht',
            '*.max' => 'Het :attribute veld mag maximaal :max karakters hebben',
            '*.min' => 'Het :attribute veld moet minimaal :min karakters hebben',
            '*.unique' => 'Het :attribute veld moet uniek zijn',
        ];
    }
}
