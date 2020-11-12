<div class="card">
    <div class="card-header bg-white">
        <h4>{{ __('qa_app::question.headers.list') }}</h4>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-sm table-inverse mb-0">
                <thead class="thead-inverse">
                    <tr>
                        <th>{{ __('qa_app::labels.question') }}</th>
                        <th>{{ __('qa_app::labels.question_value') }}</th>
                        <th>{{ __('qa_app::labels.qa_form') }}</th>
                        <th>{{ __('qa_app::labels.question_type') }}</th>
                        <th>{{ __('qa_app::labels.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($questions as $question)
                        <tr>
                            <td scope="row">
                                <a href="{{ route('qa_app.question.show', $question->id) }}">
                                    {{ $question->text }}
                                </a>
                            </td>
                            <td>
                                {{ number_format($question->points, 2) }}
                            </td>
                            <td>
                                <a href="{{ route('qa_app.form.show', $question->form->id) }}" target="_form">
                                    {{ $question->form->name }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('qa_app.question_type.show', $question->questionType->id) }}" target="_questionType">
                                    {{ $question->questionType->name }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('qa_app.question.edit', $question->id) }}" class="btn btn-warning btn-sm">
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