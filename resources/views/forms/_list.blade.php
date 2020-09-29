<div class="card">
    <div class="card-header bg-white">
        <h4>QA Forms List</h4>
    </div>
    <div class="card-body p-0">
        <table class="table table-sm table-inverse table-responsive-sm mb-0">
            <thead class="thead-inverse">
                <tr>
                    <th>{{ __('qa_app::labels.qa_form') }}</th>
                    <th>{{ __('qa_app::labels.question') }}</th>
                    <th>{{ __('qa_app::labels.points_possible') }}</th>
                    <th>{{ __('qa_app::labels.passing_goal') }}</th>
                    <th>{{ __('qa_app::labels.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($forms as $form)
                    <tr>
                        <td scope="row">
                            <a href="{{ route('qa_app.form.show', $form->id) }}">
                                {{ $form->name }}
                            </a>
                        </td>
                        <td>
                            <span class="badge badge-secondary">{{ $form->questions->count() }}</span>
                        </td>
                        <td>
                            <span class="badge badge-secondary">{{ number_format($form->questions()->sum('points'), 2) }}</span>
                        </td>
                        <td>
                            {{ number_format($form->goal_percentage * 100, 2) }}%
                        </td>
                        <td>
                            <a href="{{ route('qa_app.form.edit', $form->id) }}" class="btn btn-warning btn-sm">
                                {{ __('qa_app::labels.edit') }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
</div>