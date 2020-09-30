<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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
        if(! $this->item)
            return [
                'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ];
        else
            return [
                'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ];
    }
}
