<?php

namespace Dainsys\QAApp\Http\Controllers;

use Dainsys\QAApp\Http\Requests\QuestionStoreRequest;
use Dainsys\QAApp\Http\Requests\QuestionUpdateRequest;
use Dainsys\QAApp\Models\Question;
use Dainsys\QAApp\Repositories\QuestionRepository;
use Illuminate\Support\Facades\Gate;

class QuestionController extends BaseController
{
    public function index()
    {
        if (Gate::denies('qa_app.is_admin')) {
            abort(403);
        }

        return view('qa_app::questions.index', [
            'questions' => QuestionRepository::all(),
            'formsList' => (new Question())->formsList,
            'questionTypesList' => (new Question())->questionTypesList
        ]);
    }

    public function show(Question $question)
    {
        if (Gate::denies('qa_app.is_admin')) {
            abort(403);
        }

        return view('qa_app::questions.show', [
            'question' => $question
        ]);
    }

    public function store(QuestionStoreRequest $request)
    {
        if (Gate::denies('qa_app.is_admin')) {
            abort(403);
        }

        $question = Question::create($request->all());

        return redirect()->route('qa_app.question.index');
    }

    public function edit(Question $question)
    {
        if (Gate::denies('qa_app.is_admin')) {
            abort(403);
        }

        return view('qa_app::questions.edit', [
            'question' => $question,
            'formsList' => $question->formsList,
            'questionTypesList' => $question->questionTypesList
        ]);
    }

    public function update(QuestionUpdateRequest $request, Question $question)
    {
        if (Gate::denies('qa_app.is_admin')) {
            abort(403);
        }

        $question->update($request->all());

        return redirect()->route('qa_app.question.index');
    }
}
