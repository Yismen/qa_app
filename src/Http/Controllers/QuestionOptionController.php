<?php

namespace Dainsys\QAApp\Http\Controllers;

use Dainsys\QAApp\Http\Requests\QuestionOptionStoreRequest;
use Dainsys\QAApp\Http\Requests\QuestionOptionUpdateRequest;
use Dainsys\QAApp\Models\QuestionOption;
use Dainsys\QAApp\Repositories\QuestionOptionRepository;
use Illuminate\Support\Facades\Gate;

class QuestionOptionController extends BaseController
{
    public function index()
    {
        if (Gate::denies('qa_app.is_admin')) {
            abort(403);
        }

        return view('qa_app::question_options.index', [
            'question_options' => QuestionOptionRepository::all(),
            'questionTypesList' => (new QuestionOption())->questionTypesList,
        ]);
    }

    public function show(QuestionOption $question_option)
    {
        if (Gate::denies('qa_app.is_admin')) {
            abort(403);
        }
        return view('qa_app::question_options.show', [
            'question_option' => $question_option
        ]);
    }

    public function store(QuestionOptionStoreRequest $request)
    {
        if (Gate::denies('qa_app.is_admin')) {
            abort(403);
        }
        $question_option = QuestionOption::create($request->all());

        return redirect()->route('qa_app.question_option.index');
    }

    public function edit(QuestionOption $question_option)
    {
        if (Gate::denies('qa_app.is_admin')) {
            abort(403);
        }
        return view('qa_app::question_options.edit', [
            'question_option' => $question_option,
            'questionTypesList' => $question_option->questionTypesList
        ]);
    }

    public function update(QuestionOptionUpdateRequest $request, QuestionOption $question_option)
    {
        if (Gate::denies('qa_app.is_admin')) {
            abort(403);
        }

        $question_option->update($request->all());

        return redirect()->route('qa_app.question_option.index');
    }
}
