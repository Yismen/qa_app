<div class="card">
    <div class="card-header bg-white">
        <h4>QA Forms List</h4>
    </div>
    <div class="card-body p-0">
        <table class="table table-sm table-inverse table-responsive-sm mb-0">
            <thead class="thead-inverse">
                <tr>
                    <th>QA Form:</th>
                    <th>Passing Goal %:</th>
                    <th>Questions:</th>
                    <th>Actions:</th>
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
                            {{ number_format($form->goal_percentage * 100, 2) }}%
                        </td>
                        <td>
                            <span class="badge badge-secondary">{{ $form->questions->count() }}</span>
                        </td>
                        <td>
                            <a href="{{ route('qa_app.form.edit', $form->id) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
</div>