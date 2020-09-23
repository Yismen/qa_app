@extends('qa_app::app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-10 mb-3">
            <div class="card">
                <div class="card-header bg-white">
                    Complete an Audit
                </div>

                <div class="card-body">
                    <x-dc-form route="{{ route('qa_app.audit.store') }}">  
                       <div class="row">
                           <div class="col-sm-4">
                            <x-dc-select-field
                                    :field-value="old('form_id', optional($form ?? null)->id)" 
                                    field-name="form_id" 
                                    label-name="Form:"
                                    :data-array="[old('form_id', optional($form ?? null)->id) => optional($form ?? null)->name]"
                                    readonly="readonly"
                                />                        
                            </div>
                            <div class="col-sm-4">
                                <x-dc-select-field
                                    :field-value="old('user_id', optional($user ?? null)->id)" 
                                    field-name="user_id" 
                                    label-name="User:"
                                    :data-array="[old('user_id', optional($user ?? null)->id) => optional($user ?? null)->name]"
                                    readonly="readonly"
                                />
                            </div>
                            <div class="col-sm-4">
                                <x-dc-input-field
                                    type="date"
                                    :field-value="old('production_date', optional($audit ?? null)->production_date)" 
                                    field-name="production_date" 
                                    label-name="Date:"
                                />
                            </div>
                       </div>
                       <ul class="list-group">
                           @foreach ($form->questions as $question)
                            <li class="list-group-item py-2">                                
                                <x-dc-select-field
                                    :field-value="old('answers.*', optional($question ?? null)->value)" 
                                    field-name="answers[{{ $question->id }}]" 
                                    label-name="{{ $question->text }}:"
                                    :data-array="$question->questionType->questionOptions()->pluck('name', 'id')"
                                />    
                            </li>                               
                           @endforeach
                       </ul>
                       <button type="submit" class="btn btn-primary">START AUDIT</button>
                    </x-dc-form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    
@endpush