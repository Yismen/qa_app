<?php

namespace Dainsys\QAApp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuditStoreRequest extends FormRequest
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
            'form_id' => 'required|exists:qa_app_forms,id',
            'user_id' => 'required|exists:users,id',
            'production_date' => 'required|date',
            'transaction' => 'required|min:2|unique:qa_app_audits,transaction',
            'answers' => 'required|array',
            'answers.*' => 'required|exists:qa_app_question_options,id',
        ];
    }

    public function messages()
    {
        return [
            'answers.required' => "This form does not have questions assigned. Please create some questions!",
            'answers.*.required' => 'Please select one!'
        ];
    }
}
