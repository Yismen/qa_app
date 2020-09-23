@extends('qa_app::app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-10 col-lg-8 mb-3">
            <div class="card">
                <div class="card-header bg-white">
                    Create a New Audit
                </div>

                <div class="card-body">
                    <x-dc-form route="{{ route('qa_app.audit.create') }}">  
                       {{-- @include('qa_app::audits._form') --}}
                       
                       <div class="row">
                           <div class="col-sm-6">
                                <x-dc-select-field
                                    :field-value="old('form_id', optional($form_id ?? null)->form_id)" 
                                    field-name="form_id" 
                                    label-name="Select a Form:"
                                    :data-array="$formsList"
                                />
                        
                            </div>
                            <div class="col-sm-6">
                                <x-dc-select-field
                                    :field-value="old('user_id', optional($user_id ?? null)->user_id)" 
                                    field-name="user_id" 
                                    label-name="Select a User:"
                                    :data-array="$usersList"
                                />
                            </div>
                       </div>

                       <button type="submit" class="btn btn-primary">START AUDIT</button>
                    </x-dc-form> 
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-10 col-lg-8">
            @include('qa_app::audits._dashboard')
            @include('qa_app::audits._list')
        </div>
    </div>
</div>
@endsection

@push('scripts')
    
@endpush