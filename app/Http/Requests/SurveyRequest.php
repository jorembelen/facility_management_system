<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurveyRequest extends FormRequest
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
            'survey_score' => 'required',
            'survey_comments' => 'required_if:survey_score,2,1',
        ];
    }

    public function messages()
    {
        return [
            'survey_comments.required_if' => 'Comment field is required if survey score is between 1 & 2.',
        ];
    }

}
