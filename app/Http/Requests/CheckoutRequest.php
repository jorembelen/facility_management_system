<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'building_id' => 'required',
            'checkin_date' => 'required',
            'checkout_date' => 'required',
            'user_id' => 'required',
            // 'reason' => 'required|string|min:5',
            'attachment' => 'mimes:zip,doc,docx,xlsx,xls,pdf,csv',
        ];
    }
}
