<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class AllUsersRequest extends FormRequest
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

        if(user_type() == 'company')
            return [
                'name' => 'required',
                'mobile' => 'required|numeric|min:9|unique:companies,mobile,'.logged_user()->id,
                // 'password' => 'required|confirmed|min:6',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        elseif(user_type() == 'seller')
            return [
                'name' => 'required',
                'mobile' => 'required|numeric|min:9|unique:sellers,mobile,'.logged_user()->id,
                // 'password' => 'required|confirmed|min:6',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        elseif(user_type() == 'broker')
            return [
                'name' => 'required',
                'mobile' => 'required|numeric|min:9|unique:brokers,mobile,'.logged_user()->id,
                // 'password' => 'required|confirmed|min:6',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        elseif(user_type() == 'rep')
            return [
                'name' => 'required',
                'mobile' => 'required|numeric|min:9|unique:reps,mobile,'.logged_user()->id,
                // 'password' => 'required|confirmed|min:6',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        else
            return [
                'name' => 'required',
                'mobile' => 'required|numeric|min:9|unique:users,mobile,'.logged_user()->id,
                // 'password' => 'required|confirmed|min:6',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ];
    }
}
