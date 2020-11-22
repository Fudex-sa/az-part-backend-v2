<?php

namespace App\Http\Requests\Rep;

use Illuminate\Foundation\Http\FormRequest;

class RepPriceRequest extends FormRequest
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
            'car_size' => 'required'
        ];
    }

    public function messages()
    {
        return [
            '_from.required' => __('site.choose_tashlih_region'),
            'city_id.required' => __('site.city_required'),
            'price.required' => __('site.price_required'),
            'car_size.required' => __('site.car_size_required')
        ];
    }
}
