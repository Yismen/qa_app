@extends('qa_app::app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-10 col-lg-8 mb-3">
            <div class="card mb-2">
                <div class="card-header bg-white">
                    <h4>
                        {{ __('qa_app::audit.show.form.header') }}
                        <a href="{{ route('qa_app.audit.index') }}" class="float-right" title="Back to Audits List">{{ __('qa_app::labels.all') }}</a>
                    </h4>
                </div>

                <div class="card-body p-0">
                    <table class="table mb-0">
                        <tbody>
                            <tr>
                                <th scope="row" class="text-left">{{ __('qa_app::labels.user') }}</th>
                                <td class="text-right">{{ $audit->user->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-left">{{ __('qa_app::labels.qa_form') }}</th>
                                <td class="text-right">{{ $audit->form->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-left">{{ __('qa_app::labels.production_date') }}</th>
                                <td class="text-right">
                                    {{ $audit->production_date->format('Y-M-d') }}, 
                                    {{ ucwords($audit->production_date->diffForHumans()) }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-left">{{ __('qa_app::labels.transaction') }}</th>
                                <td class="text-right">{{ $audit->transaction }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-left">{{ __('qa_app::labels.total_points') }}</th>
                                <td class="text-right">{{ $audit->max_points }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-left">{{ __('qa_app::labels.points_required') }}</th>
                                <td class="text-right">{{ $audit->points_goal }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-left">{{ __('qa_app::labels.points_reached') }}</th>
                                <td class="text-right">{{ $audit->points }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-left">{{ __('qa_app::labels.pass_fail') }}</th>
                                <td class="text-right">
                                    <span class="badge badge-{{ $audit->passes ? 'success' : 'danger'}}">
                                        {{ $audit->passes ? 'Passed' : 'Failed'}}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>                    
                </div>
                
                <div class="card-footer bg-white">
                    <a href="{{ route('qa_app.audit.edit', $audit->id) }}" class="btn btn-warning">{{ __('qa_app::labels.edit') }}</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white p-2">{{ __('qa_app::audit.show.questions.header') }}</div>
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('qa_app::labels.question') }}</th>
                                <th>{{ __('qa_app::labels.question_answer') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($audit->data as $response)
                            <tr>
                                <td scope="row">
                                    {{ $response->question->text }}
                                    <span class="badge badge-secondary">{{ $response->question->points }}</span>
                                </td>
                                <td>
                                    {{ $response->answer->name }}
                                    <span class="badge badge-secondary">{{ $response->answer->value * 100 }}%</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    
@endpush