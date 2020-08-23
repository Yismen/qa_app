<?php

namespace Dainsys\QAApp\Controllers;

use Dainsys\QAApp\Models\Form;

class FormController extends BaseController
{
    public function index()
    {
        return view('qa_app::forms.index', [
            'forms' => Form::all()
        ]);
    }

    public function show(Form $form)
    {
        return view('qa_app::forms.show', [
            'form' => $form
        ]);
    }

    public function create()
    {
        return view('qa_app::forms.create');
    }

    public function store()
    {
        $form = Form::create(request()->all());

        return redirect()->route('qa_app.form.index');
    }

    public function edit(Form $form)
    {
        return view('qa_app::forms.edit', [
            'form' => $form
        ]);
    }

    public function update(Form $form)
    {
        $form->update(request()->all());

        return redirect()->route('qa_app.form.index');
    }
}
