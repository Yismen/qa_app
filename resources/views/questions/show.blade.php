@extends('qa_app::app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-10 col-lg-8 mb-3">
            <div class="card">
                <div class="card-header bg-white">
                    <h4>
                        Question - {{ $question->text }}
                        <a href="{{ route('qa_app.question.index') }}" class="float-right" title="Back to Questions List">All</a>
                    </h4>
                </div>

                <div class="card-body p-0">
                    <table class="table mb-0">
                        <tbody>
                            <tr>
                                <th scope="row" class="text-left">QA Form:</th>
                                <td class="text-right">{{ $question->form->name }}%</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-left">Question Type:</th>
                                <td class="text-right">{{ $question->questionType->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-left">Question Value:</th>
                                <td class="text-right">{{ number_format($question->points, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
                
                <div class="card-footer bg-white">
                    <a href="{{ route('qa_app.question.edit', $question->id) }}" class="btn btn-warning">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    
@endpush