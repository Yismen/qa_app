<?php

namespace Dainsys\QAApp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionOptionRequest extends FormRequest
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
            'name' => 'required|min:2',
            'value' => 'required|numeric|min:0|max:1',
            'question_type_id' => 'required|exists:qa_app_question_types,id'
        ];
    }
}
