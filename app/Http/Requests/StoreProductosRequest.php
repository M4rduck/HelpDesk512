<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductosRequest extends FormRequest
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
        return [
            'name' => 'required',
            'descritpion' => 'required',
            'serial' => 'required',
            'has_module' => 'required',
            'has_license' => 'required',
            'is_active' => 'required',
            'is_deleted' => 'required'
        ];
    }
}
