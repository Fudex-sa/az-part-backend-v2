<?php

namespace App\Http\Requests\Rep;

use Illuminate\Foundation\Http\FormRequest;

class MyPricesRequest extends FormRequest
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
            '_from' => 'required',
            'city_id' => 'required',
            'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            '_from.required' => __('site.tashlih_region_required'),
            'city_id.required' => __('site.city_to_required'),
            'price.required' => __('site.delivery_price_required'),
        ];
    }
}
