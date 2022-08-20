<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffStoreRequest extends FormRequest
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
            'password' => 'nullable|max:50',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|digits:10',
            'badge' => 'required|max:50|unique:users,badge',
            'username' => 'required|max:50|unique:users,username',
            'email' => 'required|unique:users|email|max:50',
        ];
    }
}
