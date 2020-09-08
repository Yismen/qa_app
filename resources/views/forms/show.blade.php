@extends('qa_app::app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-10 col-lg-8 mb-3">
            <div class="card">
                <div class="card-header bg-white">
                    <h4>
                        QA Form - {{ $form->name }}
                        <a href="{{ route('qa_app.form.index') }}" class="float-right" title="Back to QA Forms List">All</a>
                    </h4>
                </div>

                <div class="card-body p-0">
                    <table class="table mb-0">
                        <tbody>
                            <tr>
                                <th scope="row" class="text-left">Total Points</th>
                                <td class="text-right">{{ number_format($form->questions()->sum('points'), 2) }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-left">Passing Goal %</th>
                                <td class="text-right">{{ number_format($form->goal_percentage * 100, 2) }}%</td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>

                <div class="card-body p-0">
                    <h6 class="p-3">Questions</h6>
                    <div class="list-group">
                        @foreach ($form->questions as $question)
                            <a href="{{ route('qa_app.question.show', $question->id) }}" class="list-group-item list-group-item-action py-2">
                                {{ $question->text }}
                                <span class="badge badge-secondary float-right">
                                    {{ $question->value }}    
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <a href="{{ route('qa_app.form.edit', $form->id) }}" class="btn btn-warning">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    
@endpush