<?php

namespace Dainsys\QAApp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionTypeRequest extends FormRequest
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
            'name' => 'required|min:2|unique:qa_app_question_types,name,' . request('question_type')->id,
        ];
    }
}
