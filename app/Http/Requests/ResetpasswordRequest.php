<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetpasswordRequest extends FormRequest
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
            'password' => 'required|confirmed|min:8|max:50',
            // 'password' => 'required|confirmed|min:8|max:50|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ];
    }
    // public function messages()
    // {
    //     return [
    //         'password.regex' => 'Password should have atleast one Capital, Number and characters(@,#,$,!).',
    //     ];
    // }
    
}
