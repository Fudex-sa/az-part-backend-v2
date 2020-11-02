<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRequest extends FormRequest
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
            'country_id' => 'required|numeric',
            'region_id' => 'required|numeric',
            'city_id' => 'required|numeric',            
            // 'rep_price_id' => 'required|numeric',            
        ];
    }


    public function messages()
    {
        return [           
            'country_id.required' =>  __('site.country_required'),
            'region_id.required' =>  __('site.region_required'),
            'city_id.required' =>  __('site.city_required'),            
            // 'rep_price_id.required' =>  __('site.rep_required'),            
        ];
    }
}
