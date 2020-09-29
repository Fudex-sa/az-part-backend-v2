<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PieceAltRequest extends FormRequest
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
                'name_ar' => 'required|max:200|unique:piece_alts,name_ar,'.$this->id,            
            ];
        
        else
            return [
                'name_ar' => 'required|max:200',                
            ];
    }
}
