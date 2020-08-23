<?php

namespace Dainsys\QAApp\Controllers;

use Dainsys\QAApp\Models\Question;

class QuestionController extends BaseController
{
    public function index()
    {
        return view('qa_app::questions.index', [
            'questions' => Question::all()
        ]);
    }

    public function show(Question $question)
    {
        return view('qa_app::questions.show', [
            'question' => $question
        ]);
    }

    public function create()
    {
        return view('qa_app::questions.create');
    }

    public function store()
    {
        $question = Question::create(request()->all());

        return redirect()->route('qa_app.question.index');
    }

    public function edit(Question $question)
    {
        return view('qa_app::questions.edit', [
            'question' => $question
        ]);
    }

    public function update(Question $question)
    {
        $question->update(request()->all());

        return redirect()->route('qa_app.question.index');
    }
}
