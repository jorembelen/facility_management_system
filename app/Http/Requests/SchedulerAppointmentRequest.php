<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchedulerAppointmentRequest extends FormRequest
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
            'user_id' => 'required',
            'work_category' => 'required',
            'work_category_id' => 'required',
            'building_id' => 'required',
            'date' => 'required|date',
            'time_start' => 'required|date_format:H:i',
            'time_end' => 'required|date_format:H:i|after:time_start',
            'job_description' => 'required',
            'other_description' => 'required_if:job_description,Others',
            'job_location' => 'required',
            'documents' => 'mimes:zip,doc,docx,xlsx,xls,pdf|max:2048M',
            'images.*' => 'image|mimes:jpeg,bmp,png,gif,svg,jpg|max:5048',
        ];
    }

    public function messages()
    {
        return [
            'images.*.image' => 'Please attach only image type.',
            'user_id.required' => 'The tenant field is required.',
            'time_start.required' => 'Please select starting appointment time.',
            'time_end.required' => 'Please select ending appointment time.',
            'work_category_id.required' => 'The job category is required.',
            'other_description.required_if' => 'Please provide other job description.',
        ];
    }

}
