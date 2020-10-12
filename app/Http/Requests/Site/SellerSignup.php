<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class SellerSignup extends FormRequest
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
        if($this->user_type == 'b')
            return [
                'name' => 'required',
                'mobile' => 'required|numeric|min:9|unique:brokers,mobile,'.$this->id,
                'password' => 'required|confirmed|min:6',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ];
        
        else
            return [
                'name' => 'required',
                'mobile' => 'required|numeric|min:9|unique:sellers,mobile,'.$this->id,
                'password' => 'required|confirmed|min:6',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ];
    }
}
