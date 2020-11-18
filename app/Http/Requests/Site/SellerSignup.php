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
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'country_id' => 'required',
                'region_id' => 'required',
                'city_id' => 'required',
            ];
        
        else
            return [
                'name' => 'required',
                'mobile' => 'required|numeric|min:9|unique:sellers,mobile,'.$this->id,
                'password' => 'required|confirmed|min:6',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'country_id' => 'required',
                'region_id' => 'required',
                'city_id' => 'required',
            ];
    }

    public function messages()
    {
        return [
            'country_id.required' => __('site.country_required'),
            'region_id.required' => __('site.region_required'),
            'city_id.required' => __('site.city_required'),
        ];
    }
}
