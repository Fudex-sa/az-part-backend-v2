<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PackageRestore extends FormRequest
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
            'type' => 'required',
            'title_ar' => 'required',
            'title_en' => 'required',
            'title_hi' => 'required',
            'stores_no' => 'required',
            'price' => 'required',
            'discount' => 'required',
        ];
    }
}
