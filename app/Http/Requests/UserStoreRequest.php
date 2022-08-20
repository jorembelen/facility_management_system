<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => 'required|max:50',
            'username' => 'required|max:50|unique:users,username',
            'role' => 'max:50',
            'profile_photo_path' => 'max:50',
            'email' => 'required|unique:users|email|max:50',
            'password' => 'sometimes|confirmed|min:6',
        ];
    }
}
