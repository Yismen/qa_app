<div class="card">
    <div class="card-header bg-white">
        <h4>{{ __('qa_app::question_option.list.header') }}</h4>
    </div>
    <div class="card-body p-0">
        <table class="table table-sm table-inverse table-responsive-sm mb-0">
            <thead class="thead-inverse">
                <tr>
                    <th>{{ __('qa_app::labels.question_option') }}</th>
                    <th>{{ __('qa_app::labels.question_option_value') }}</th>
                    <th>{{ __('qa_app::labels.question_type') }}</th>
                    <th>{{ __('qa_app::labels.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($question_options as $question_option)
                    <tr>
                        <td scope="row">
                            <a href="{{ route('qa_app.question_option.show', $question_option->id) }}">
                                {{ $question_option->name }}
                            </a>
                        </td>
                        <td>
                            {{ number_format($question_option->value, 2) * 100 }}%
                        </td>
                        <td>
                            {{ optional($question_option->questionType)->name }}
                        </td>
                        <td>
                            <a href="{{ route('qa_app.question_option.edit', $question_option->id) }}" class="btn btn-warning btn-sm">
                                {{ __('qa_app::labels.edit') }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
</div>