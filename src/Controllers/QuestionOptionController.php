<?php

namespace Dainsys\QAApp\Controllers;

use Dainsys\QAApp\Models\QuestionOption;

class QuestionOptionController extends BaseController
{
    public function index()
    {
        return view('qa_app::question_options.index', [
            'question_options' => QuestionOption::all()
        ]);
    }

    public function show(QuestionOption $question_option)
    {
        return view('qa_app::question_options.show', [
            'question_option' => $question_option
        ]);
    }

    public function create()
    {
        return view('qa_app::question_options.create');
    }

    public function store()
    {
        $question_option = QuestionOption::create(request()->all());

        return redirect()->route('qa_app.question_option.index');
    }

    public function edit(QuestionOption $question_option)
    {
        return view('qa_app::question_options.edit', [
            'question_option' => $question_option
        ]);
    }

    public function update(QuestionOption $question_option)
    {
        $question_option->update(request()->all());

        return redirect()->route('qa_app.question_option.index');
    }
}
