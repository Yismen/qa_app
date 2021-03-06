@extends('qa_app::app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-10 col-lg-8 mb-3">
            <div class="card">
                <div class="card-header bg-white">
                    {{ __('qa_app::question_option.index.header') }}
                </div>

                <div class="card-body">
                    <x-dc-form route="{{ route('qa_app.question_option.store') }}">  
                       @include('qa_app::question_options._form')

                       <button type="submit" class="btn btn-primary">{{ __('qa_app::labels.create') }}</button>
                    </x-dc-form> 
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-10 col-lg-8">
            @include('qa_app::question_options._list')
        </div>
    </div>
</div>
@endsection

@push('scripts')
    
@endpush