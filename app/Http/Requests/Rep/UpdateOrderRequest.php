<?php

namespace App\Http\Requests\Rep;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'delivery_time' => 'required_if:status,8',
            'reject_reason' => 'required_if:status,9'
        ];
    }
    
    public function messages()
    {
        return [
            'delivery_time.required_if' => __('site.delivery_time_required'),
            'reject_reason.required_if' => __('site.reject_reason_required'),
        ];
    }
}
