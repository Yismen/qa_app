@extends('qa_app::app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-10 col-lg-8 mb-3">
            <div class="card">
                <div class="card-header bg-white">
                    <h4>
                        {{ __('qa_app::question_type.edit.header') }}
                        <a href="{{ route('qa_app.question_type.show', $question_type->id) }}">{{ $question_type->name }}</a>
                        <a href="{{ route('qa_app.question_type.index') }}" class="float-right" title="Back to Question Types List">{{ __('qa_app::labels.all') }}</a>
                    </h4>
                </div>

                <div class="card-body">
                    <x-dc-form route="{{ route('qa_app.question_type.update', $question_type->id) }}">  
                        @method('PUT')
                        <x-dc-input-field-addon
                            :field-value="old('name', optional($question_type ?? null)->name)" 
                            field-name="name" 
                            label-name="{{ __('qa_app::labels.question_type') }}"
                            button-action="{{ __('qa_app::question_type.edit.button') }}"
                            btn-class="btn-warning"
                        />      
                    </x-dc-form> 
                </div>

                <div class="card-footer bg-white">
                    <h5>{{ __('qa_app::question_type.show.question_options_header') }}</h5>
                    <ul class="list-group">
                        @foreach ($question_type->questionOptions as $question_option)
                            <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                                {{ $question_option->name }}
                                <span class="badge badge-secondary badge-pill">{{ $question_option->value }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    
@endpush