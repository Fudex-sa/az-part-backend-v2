<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class PartSearchRequest extends FormRequest
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
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required',
            'country' => 'required',
            'region' => 'required',
            'city' => 'required',
            'search_type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'brand.required' =>  __('site.brand_required'),
            'model.required' =>  __('site.model_required'),
            'year.required' =>  __('site.year_required'),
            'country.required' =>  __('site.country_required'),
            'region.required' =>  __('site.region_required'),
            'city.required' =>  __('site.city_required'),
            'search_type.required' =>  __('site.search_type_required'),
        ];
    }
}
