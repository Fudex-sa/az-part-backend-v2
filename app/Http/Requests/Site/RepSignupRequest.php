<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class RepSignupRequest extends FormRequest
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
            'mobile' => 'required|numeric|min:9|unique:reps,mobile,'.$this->id,
            'password' => 'required|confirmed|min:6',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    
    }
}
