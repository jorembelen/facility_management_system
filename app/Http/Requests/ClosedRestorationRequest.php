<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClosedRestorationRequest extends FormRequest
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
            'closing_attachment' => 'mimes:zip,doc,docx,xlsx,xls,pdf',
        ];
    }
}
