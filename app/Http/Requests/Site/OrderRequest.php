<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'model_id' => 'required|numeric',
            'year' => 'required|numeric',
            'country_id' => 'required|numeric',
            'region_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'type' => 'required',
            // 'piece_alt_id' => 'required|numeric',
            // 'price' => 'required',
            
        ];
    }

    public function messages()
    {
        return [
            'brand_id.required' =>  __('site.brand_required'),
            'model_id.required' =>  __('site.model_required'),
            'year.required' =>  __('site.year_required'),
            'country_id.required' =>  __('site.year_required'),
            'region_id.required' =>  __('site.region_required'),
            'city_id.required' =>  __('site.city_required'),
            'type.required' =>  __('site.search_type_required'),

            // 'piece_alt_id.required' =>  __('site.piece_required'),
            // 'price.required' =>  __('site.price_required'),
 
        ];
    }
}
