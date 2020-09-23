<?php

namespace Dainsys\QAApp\Http\Controllers;

use Dainsys\QAApp\Http\Requests\AuditCreateRequest;
use Dainsys\QAApp\Http\Requests\AuditStoreRequest;
use Dainsys\QAApp\Http\Requests\AuditUpdateRequest;
use Dainsys\QAApp\Models\Audit;
use Dainsys\QAApp\Models\Form;
use Dainsys\QAApp\Repositories\AuditRepository;
use Illuminate\Support\Facades\Gate;

class AuditController extends BaseController
{
    public function index()
    {
        if (Gate::denies('qa_app.is_auditor')) {
            abort(403);
        }

        return view('qa_app::audits.index', [
            'audits' => AuditRepository::all(),
            'formsList' => (new Audit())->formsList,
            'usersList' => (new Audit())->usersList
        ]);
    }

    public function show(Audit $audit)
    {
        if (Gate::denies('qa_app.is_auditor')) {
            abort(403);
        }

        return view('qa_app::audits.show', [
            'audit' => AuditRepository::find($audit->id)
        ]);
    }

    public function create(AuditCreateRequest $request)
    {
        if (Gate::denies('qa_app.is_auditor')) {
            abort(403);
        }

        return view('qa_app::audits.create', [
            'form' => Form::find($request->form_id)->load('questions.questionType.questionOptions'),
            'user' => resolve('App\User')::find($request->user_id)
        ]);
    }

    public function store(AuditStoreRequest $request)
    {
        if (Gate::denies('qa_app.is_auditor')) {
            abort(403);
        }

        $request->merge(Audit::getAdditionalFields($request));

        Audit::create($request->all());

        return redirect()->route('qa_app.audit.index');
    }

    public function edit(Audit $audit)
    {
        if (Gate::denies('qa_app.is_auditor')) {
            abort(403);
        }

        return view('qa_app::audits.edit', [
            'audit' => $audit,
            'formsList' => $audit->formsList,
            'auditTypesList' => $audit->auditTypesList
        ]);
    }

    public function update(AuditUpdateRequest $request, Audit $audit)
    {
        if (Gate::denies('qa_app.is_auditor')) {
            abort(403);
        }

        $audit->update($request->all());

        return redirect()->route('qa_app.audit.index');
    }
}
