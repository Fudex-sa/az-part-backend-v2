<?php

namespace App\Http\Requests\Control;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
            'title' => 'required',
            'brand_id' => 'required',
            'model_id' => 'required',
            'year' => 'required',
            'country_id' => 'required',
            'region_id' => 'required',
            'city_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'brand_id.required' =>  __('site.brand_required'),
            'model_id.required' =>  __('site.model_required'),            
            'year.required' =>  __('site.year_required'),
            'country_id.required' =>  __('site.country_required'),            
            'region_id.required' =>  __('site.region_required'),            
            'city_id.required' =>  __('site.city_required'),            
        ];
    }
}
