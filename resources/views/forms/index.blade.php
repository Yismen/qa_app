@extends('qa_app::app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-10 col-lg-8 mb-3">
            <div class="card">
                <div class="card-header bg-white">
                    {{ __('qa_app::form.index.form.header') }}
                </div>

                <div class="card-body">
                    <x-dc-form route="{{ route('qa_app.form.store') }}">  
                       @include('qa_app::forms._form')

                       <button type="submit" class="btn btn-primary">
                        {{ __('qa_app::form.index.form.button') }}</button>
                    </x-dc-form> 
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-10 col-lg-8">
            @include('qa_app::forms._list')
        </div>
    </div>
</div>
@endsection

@push('scripts')
    
@endpush