<div class="card">
    <div class="card-header bg-white">
        <h4>{{ __('qa_app::question_type.list.header') }}</h4>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-sm table-inversemb-0">
                <thead class="thead-inverse">
                    <tr>
                        <th>{{ __('qa_app::labels.question_type') }}</th>
                        <th>{{ __('qa_app::labels.question_option') }}</th>
                        <th>{{ __('qa_app::labels.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($question_types as $question_type)
                        <tr>
                            <td scope="row">
                                <a href="{{ route('qa_app.question_type.show', $question_type->id) }}">
                                    {{ $question_type->name }}
                                </a>
                            </td>
                            <td>
                                @foreach ($question_type->questionOptions as $question_option)
                                    <span class="badge badge-secondary">{{ $question_option->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('qa_app.question_type.edit', $question_type->id) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
    </div>
</div>