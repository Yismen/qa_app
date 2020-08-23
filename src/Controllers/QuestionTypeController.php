<?php

namespace Dainsys\QAApp\Controllers;

use Dainsys\QAApp\Models\QuestionType;

class QuestionTypeController extends BaseController
{
    public function index()
    {
        return view('qa_app::question_types.index', [
            'question_types' => QuestionType::all()
        ]);
    }

    public function show(QuestionType $question_type)
    {
        return view('qa_app::question_types.show', [
            'question_type' => $question_type
        ]);
    }

    public function create()
    {
        return view('qa_app::question_types.create');
    }

    public function store()
    {
        $question_type = QuestionType::create(request()->all());

        return redirect()->route('qa_app.question_type.index');
    }

    public function edit(QuestionType $question_type)
    {
        return view('qa_app::question_types.edit', [
            'question_type' => $question_type
        ]);
    }

    public function update(QuestionType $question_type)
    {
        $question_type->update(request()->all());

        return redirect()->route('qa_app.question_type.index');
    }
}
