@extends('qa_app::app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-10 col-lg-8 mb-3">
            <div class="card">
                <div class="card-header bg-white">
                    <h4>
                        <a href="{{ route('qa_app.audit.show', $audit->id) }}" title="Show Details">Edit Audit</a>
                        <a href="{{ route('qa_app.audit.index') }}" class="float-right" title="Back to Audits List">All</a>
                    </h4>
                </div>

                <div class="card-body">
                    <x-dc-form route="{{ route('qa_app.audit.update', $audit->id) }}">  
                        @method('PUT')
                        @include('qa_app::audits._form-edit')

                       <button type="submit" class="btn btn-warning mt-3">UPDATE</button>    
                    </x-dc-form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    
@endpush