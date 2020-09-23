{{ dump($audits) }}
{{-- <div class="card">
    <div class="card-header bg-white">
        <h4>Audits List</h4>
    </div>
    <div class="card-body p-0">
        <table class="table table-sm table-inverse table-responsive-sm mb-0">
            <thead class="thead-inverse">
                <tr>
                    <th>Audit:</th>
                    <th>Value:</th>
                    <th>QA Form:</th>
                    <th>Type:</th>
                    <th>Actions:</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($audits as $audit)
                    <tr>
                        <td scope="row">
                            <a href="{{ route('qa_app.audit.show', $audit->id) }}">
                                {{ $audit->text }}
                            </a>
                        </td>
                        <td>
                            {{ number_format($audit->points, 2) }}
                        </td>
                        <td>
                            <a href="{{ route('qa_app.form.show', $audit->form->id) }}" target="_form">
                                {{ $audit->form->name }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('qa_app.audit_type.show', $audit->auditType->id) }}" target="_auditType">
                                {{ $audit->auditType->name }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('qa_app.audit.edit', $audit->id) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
</div> --}}