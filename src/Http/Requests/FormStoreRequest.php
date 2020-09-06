<?php

namespace Dainsys\QAApp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormStoreRequest extends FormRequest
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
            'name' => 'required|min:2|unique:qa_app_forms,name',
            'goal_percentage' => 'required|numeric|min:0|max:100',
        ];
    }
}
