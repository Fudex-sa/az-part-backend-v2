<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class ElecRequest extends FormRequest
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
            "piece_alt_id.*"  => "required|min:1",
            // 'piece_alt_id' => 'required|array|min:1',
        ];
    }

    public function messages()
    {
        return [
            'piece_alt_id.*.required' =>  __('site.piece_required'),
        ];
    }
}
