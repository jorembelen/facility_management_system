<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'password' => 'sometimes|nullable|confirmed|min:6|max:50',
            // 'password' => 'sometimes|nullable|confirmed|min:6|max:50|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'image.*' => 'image|mimes:jpeg,bmp,png,gif,svg,jpg|max:512',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'password.regex' => 'Password should have atleast one Capital, Number and characters(@,#,$,!).',
    //     ];
    // }

}
