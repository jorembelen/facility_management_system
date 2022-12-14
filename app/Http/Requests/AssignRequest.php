<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignRequest extends FormRequest
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
            'tenant_id' => 'required',
            'assignedBy' => 'required',
            'building_id' => 'required',
            'assigned_date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tenant_id.required' => 'The tenant is required.',
            'assigned_date.required' => 'The assign date is required.',
        ];
    }

}
