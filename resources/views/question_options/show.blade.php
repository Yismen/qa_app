@extends('qa_app::app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-10 col-lg-8 mb-3">
            <div class="card">
                <div class="card-header bg-white">
                    <h4>
                        Question Option - {{ $question_option->name }}
                        <a href="{{ route('qa_app.question_option.index') }}" class="float-right" title="Back to Question Options List">All</a>
                    </h4>
                </div>

                <div class="card-body">
                    <h5>Question Options</h5>
                    <ul class="list-group">
                        @foreach ($question_option->questionOptions as $question_option)
                            <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                                {{ $question_option->name }}
                                <span class="badge badge-secondary badge-pill">{{ $question_option->value }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="card-footer bg-white">
                    <a href="{{ route('qa_app.question_option.edit', $question_option->id) }}" class="btn btn-warning">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    
@endpush