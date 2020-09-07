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

                <div class="card-body p-0">
                    <table class="table mb-0">
                        <tbody>
                            <tr>
                                <th scope="row" class="text-left">Value %</th>
                                <td class="text-right">{{ number_format($question_option->value, 2) }}%</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-left">Question Type</th>
                                <td class="text-right">
                                    <a href="{{ route('qa_app.question_type.show', optional($question_option->questionType)->id) }}" target="_question_type">
                                        {{ optional($question_option->questionType)->name }}
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
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