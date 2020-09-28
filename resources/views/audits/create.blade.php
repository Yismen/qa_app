@extends('qa_app::app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-10 mb-3">
            <div class="card">
                <div class="card-header bg-white">
                    {{ __('qa_app::audit.create.form.header') }}

                    <a name="cancel_audit" id="cancel_audit" class="btn btn-danger float-right btn-sm" href="{{ route('qa_app.audit.index') }}" title="Cancel Audit" role="button" onclick="closeAuditForm(event)">X</a>
                </div>

                <div class="card-body">
                    <x-dc-form route="{{ route('qa_app.audit.store') }}">  
                       @include('qa_app::audits._form')
                       
                    @error('answers')
                        <p class="text-sm text-danger m-2">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                       <button type="submit" class="btn btn-primary mt-3">{{ __('qa_app::audit.create.form.button') }}</button>
                    </x-dc-form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script defer>
        function closeAuditForm(event) {
            event.preventDefault()
            let url = event.target.href

            if (confirm("Changes will be discarded. Are you sure?")) {
                location.replace(url)
            }
        }
    </script>
@endpush