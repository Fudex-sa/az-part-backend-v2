<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class UserInterestRequest extends FormRequest
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
            'brand_id' => 'required|numeric',
            'car_model_id' => 'required|numeric',
            'year' => 'required|numeric',
            'country_id' => 'required|numeric',
            'region_id' => 'required|numeric',
            'city_id' => 'required|numeric',


        ];
    }

    public function messages()
    {
        return [
            'brand_id.required' =>  __('site.brand_required'),
            'car_model_id.required' =>  __('site.model_required'),
            'year.required' =>  __('site.year_required'),
            'country_id.required' =>  __('site.country_required'),
            'region_id.required' =>  __('site.region_required'),
            'city_id.required' =>  __('site.city_required'),
        

        ];
    }
}
