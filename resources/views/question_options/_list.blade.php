<div class="card">
    <div class="card-header bg-white">
        <h4>Question Options List</h4>
    </div>
    <div class="card-body p-0">
        <table class="table table-sm table-inverse table-responsive-sm mb-0">
            <thead class="thead-inverse">
                <tr>
                    <th>Question Option:</th>
                    <th>Question Options:</th>
                    <th>Actions:</th>
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
                            @foreach ($question_option->questionOptions as $question_option)
                                <span class="badge badge-secondary">{{ $question_option->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('qa_app.question_option.edit', $question_option->id) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
</div>