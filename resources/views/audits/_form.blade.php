<div class="row">
    <div class="col-sm-6 bg-light">
         <x-dc-select-field
            class="bg-light"
             :field-value="old('form_id', optional($form ?? null)->id)" 
             field-name="form_id" 
             label-name="{{ __('qa_app::labels.qa_form') }}"
             :data-array="[old('form_id', optional($form ?? null)->id) => optional($form ?? null)->name]"
             readonly="readonly"
         />                        
     </div>
     <div class="col-sm-6 bg-light">
          <x-dc-select-field
             class="bg-light"
             :field-value="old('user_id', optional($user ?? null)->id)" 
             field-name="user_id" 
             label-name="{{ __('qa_app::labels.user') }}"
             :data-array="[old('user_id', optional($user ?? null)->id) => optional($user ?? null)->name]"
             readonly="readonly"
         />
     </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <x-dc-input-field
            type="date"
            :field-value="old('production_date', optional($audit ?? null)->production_date)" 
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
    @foreach ($form->questions as $question)
     <li class="list-group-item py-2">   
        @php $field = 'answers.' . $question->id @endphp                                     
         <x-dc-select-field
             :field-value="old($field, optional($question ?? null)->value)" 
             field-name="answers[{{ $question->id }}]" 
             label-name="{{ $question->text }}:"
             :data-array="$question->questionType->questionOptions()->pluck('name', 'id')"
         />    
         @error($field)
             <strong class="text-danger">{{ $message }}</strong>
         @enderror
     </li>              
    @endforeach
</ul>