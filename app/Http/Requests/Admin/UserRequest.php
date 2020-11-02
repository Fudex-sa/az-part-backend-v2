<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                'name' => 'required|max:200',
                'password' => 'sometimes',
                'mobile' => 'required|numeric|unique:users,mobile,'.$this->id,
                // 'email' => 'required|unique:users,email,'.$this->id,                    
            ];
        
        else
            return [
                'name' => 'required|max:200',
                'password' => 'sometimes',
                'mobile' => 'required|numeric|unique:users,mobile',
                // 'email' => 'required|unique:users,email',                     
            ];
    }
}
