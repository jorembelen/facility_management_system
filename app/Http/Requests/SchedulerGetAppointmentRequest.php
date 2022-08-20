<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchedulerGetAppointmentRequest extends FormRequest
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
            'date' => 'required|exists:schedules,date',
            'category' => 'required',
            'tenant_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tenant_id.required' => 'The tenant field is required.',
            'date.exists' => 'No schedule available for this date.',
        ];
    }

}
