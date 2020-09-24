<div class="card">
    <div class="card-header bg-white">
        <h4>Audits List</h4>
    </div>
    <div class="card-body p-0">
        <table class="table table-sm table-inverse table-responsive-sm mb-0">
            <thead class="thead-inverse">
                <tr>
                    <th>Date:</th>
                    <th>User:</th>
                    <th>QA Form:</th>
                    <th>Points:</th>
                    <th>Passes:</th>
                    <th colspan="2">Actions:</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($audits as $audit)
                    <tr class="{{ $audit->passes  ? '' : 'text-danger'}}">
                        <td scope="row">
                            <a href="{{ route('qa_app.audit.show', $audit->id) }}">
                                {{ $audit->production_date->format('Y-M-d') }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('qa_app.dashboard.user', $audit->user->id) }}" target="__dashboard">
                                {{ optional($audit->user)->name }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('qa_app.dashboard.qa_form', $audit->form->id) }}" target="__dashboard">
                                {{ $audit->form->name }}
                            </a>
                        </td>
                        <td>
                            {{ number_format($audit->points, 2) }}
                        </td>
                        <td>
                            {{ $audit->passes ? 'Passed' : 'Failed' }}
                        </td>
                        <td>
                            <a href="{{ route('qa_app.audit.show', $audit->id) }}" class="btn btn-secondary btn-sm">
                                Details
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
    @if ($audits->hasPages())
        <div class="card-footer bg-white p-2">{{ $audits->links() }}</div>
    @endif
</div>