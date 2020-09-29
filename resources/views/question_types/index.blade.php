@extends('qa_app::app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-10 col-lg-8 mb-3">
            <div class="card">
                <div class="card-header bg-white">
                    <h4>{{ __('qa_app::question_type.index.header') }}</h4>
                </div>

                <div class="card-body">
                    <x-dc-form route="{{ route('qa_app.question_type.store') }}">  
                        <x-dc-input-field-addon
                            :field-value="old('name', optional($question_type ?? null)->name)" 
                            field-name="name" 
                            label-name="{{ __('qa_app::labels.question_type') }}"
                            button-action="SAVE"
                        />      
                    </x-dc-form> 
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-10 col-lg-8">
            @include('qa_app::question_types._list')
        </div>
    </div>
</div>
@endsection

@push('scripts')
    
@endpush