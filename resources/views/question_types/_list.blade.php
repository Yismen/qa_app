<div class="card">
    <div class="card-header bg-white">
        <h4>Question Types List</h4>
    </div>
    <div class="card-body p-0">
        <table class="table table-sm table-inverse table-responsive-sm mb-0">
            <thead class="thead-inverse">
                <tr>
                    <th>Question Type:</th>
                    <th>Question Options:</th>
                    <th>Actions:</th>
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