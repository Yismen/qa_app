<?php

namespace Dainsys\QAApp\Http\Controllers;

use Dainsys\QAApp\Http\Requests\FormStoreRequest;
use Dainsys\QAApp\Http\Requests\FormUpdateRequest;
use Dainsys\QAApp\Models\Form;
use Dainsys\QAApp\Repositories\FormRepository;
use Illuminate\Support\Facades\Gate;

class FormController extends BaseController
{
    public function index()
    {
        if (Gate::denies('qa_app.is_admin')) {
            abort(403);
        }

        return view('qa_app::forms.index', [
            'forms' => FormRepository::all()
        ]);
    }

    public function show(Form $form)
    {
        if (Gate::denies('qa_app.is_admin')) {
            abort(403);
        }

        return view('qa_app::forms.show', [
            'form' => $form
        ]);
    }

    public function create()
    {
        if (Gate::denies('qa_app.is_admin')) {
            abort(403);
        }

        return view('qa_app::forms.create');
    }

    public function store(FormStoreRequest $request)
    {
        if (Gate::denies('qa_app.is_admin')) {
            abort(403);
        }

        $form = Form::create($request->all());

        return redirect()->route('qa_app.form.index');
    }

    public function edit(Form $form)
    {
        if (Gate::denies('qa_app.is_admin')) {
            abort(403);
        }

        return view('qa_app::forms.edit', [
            'form' => $form
        ]);
    }

    public function update(FormUpdateRequest $request, Form $form)
    {
        if (Gate::denies('qa_app.is_admin')) {
            abort(403);
        }

        $form->update($request->all());

        return redirect()->route('qa_app.form.index');
    }
}
