<?php

namespace Dainsys\QAApp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionUpdateRequest extends FormRequest
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
            'text' => 'required|min:2|unique:qa_app_questions,text,' . request('question')->id,
            'points' => 'required|numeric|min:0|max:100',
            'form_id' => 'required|exists:qa_app_forms,id',
            'question_type_id' => 'required|exists:qa_app_question_types,id',
        ];
    }
}
