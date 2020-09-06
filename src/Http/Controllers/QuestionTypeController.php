<?php

namespace Dainsys\QAApp\Http\Controllers;

use Dainsys\QAApp\Http\Requests\StoreQuestionTypeRequest;
use Dainsys\QAApp\Http\Requests\UpdateQuestionTypeRequest;
use Dainsys\QAApp\Models\QuestionType;
use Dainsys\QAApp\Repositories\QuestionTypeRepository;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;

class QuestionTypeController extends Controller
{
    public function index()
    {
        if (Gate::denies('qa_app.is_admin')) {
            abort(403);
        }

        return view('qa_app::question_types.index', [
            'question_types' => QuestionTypeRepository::all()
        ]);
    }

    public function show(QuestionType $question_type)
    {
        if (Gate::denies('qa_app.is_admin')) {
            abort(403);
        }
        return view('qa_app::question_types.show', [
            'question_type' => $question_type
        ]);
    }

    public function create()
    {
        if (Gate::denies('qa_app.is_admin')) {
            abort(403);
        }
        return view('qa_app::question_types.create');
    }

    public function store(StoreQuestionTypeRequest $request)
    {
        if (Gate::denies('qa_app.is_admin')) {
            abort(403);
        }
        $question_type = QuestionType::create($request->all());

        return redirect()->route('qa_app.question_type.index');
    }

    public function edit(QuestionType $question_type)
    {
        if (Gate::denies('qa_app.is_admin')) {
            abort(403);
        }
        return view('qa_app::question_types.edit', [
            'question_type' => $question_type
        ]);
    }

    public function update(UpdateQuestionTypeRequest $request, QuestionType $question_type)
    {
        if (Gate::denies('qa_app.is_admin')) {
            abort(403);
        }
        $question_type->update($request->all());

        return redirect()->route('qa_app.question_type.index');
    }
}
