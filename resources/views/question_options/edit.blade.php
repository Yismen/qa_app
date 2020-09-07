@extends('qa_app::app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-10 col-lg-8 mb-3">
            <div class="card">
                <div class="card-header bg-white">
                    <h4>
                        Edit Question Option - 
                        <a href="{{ route('qa_app.question_option.show', $question_option->id) }}">{{ $question_option->name }}</a>
                        <a href="{{ route('qa_app.question_option.index') }}" class="float-right" title="Back to Question Options List">All</a>
                    </h4>
                </div>

                <div class="card-body">
                    <x-dc-form route="{{ route('qa_app.question_option.update', $question_option->id) }}">  
                        @method('PUT')
                        @include('qa_app::question_options._form')

                       <button type="submit" class="btn btn-warning">UPDATE</button>    
                    </x-dc-form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    
@endpush