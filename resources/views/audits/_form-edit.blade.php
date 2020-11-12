<div class="row">
    <div class="col-sm-6">
         <x-dc-select-field
             :field-value="old('form_id', optional($audit ?? null)->form_id)" 
             field-name="form_id" 
             label-name="{{ __('qa_app::labels.qa_form') }}"
             :data-array="$formsList"
             readonly="readonly"
         />                        
     </div>
     <div class="col-sm-6">
         <x-dc-select-field
             :field-value="old('user_id', optional($audit ?? null)->user_id)" 
             field-name="user_id" 
             label-name="{{ __('qa_app::labels.user') }}"
             :data-array="$usersList"
             readonly="readonly"
         />     
     </div>
</div>

<div class="row">    
    <div class="col-sm-6">
        <x-dc-input-field
            type="date"
            :field-value="old('production_date', optional(optional($audit ?? null)->production_date)->format('Y-m-d'))" 
            field-name="production_date" 
            label-name="{{ __('qa_app::labels.production_date') }}"
        />
    </div>
    <div class="col-sm-6">
        <x-dc-input-field
            :field-value="old('transaction', optional($audit ?? null)->transaction)" 
            field-name="transaction" 
            label-name="{{ __('qa_app::labels.transaction') }}"
        />
    </div>
</div>
<ul class="list-group">
    @if ($audit->data)
        @foreach ($audit->data as $answer)
            @php $field = 'answers.' . $answer->question->id @endphp 
            <li class="list-group-item py-2">                                
                <x-dc-select-field
                    :field-value="old($field, optional($answer->answer ?? null)->id)" 
                    field-name="answers[{{ $answer->question->id }}]" 
                    label-name="{{ $answer->question->text }}:"
                    :data-array="$answer->question->questionOptionsList"
                />    
                @error($field)
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </li>                               
        @endforeach
    @endif
</ul>