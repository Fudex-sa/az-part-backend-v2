<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;

class AvailableModelRequest extends FormRequest
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
        if($this->id)
            return [
                'brand_id' => 'required',
                'model_id' => 'required',
                'year' => 'required',
            ];
        else
            return [
                'brand_id' => 'required',
                'model_id' => 'required',
                'year' => 'required',
            ];
    }

    public function messages()
    {
        return [
            'brand_id.required' =>  __('site.brand_required'),
            'model_id.required' =>  __('site.model_required'),
            'years.required' =>  __('site.year_required'),
            'year.required' =>  __('site.year_required'),
             
        ];
    }

}
