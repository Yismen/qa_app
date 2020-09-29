<x-dc-input-field 
    :field-value="old('name', optional($question_option ?? null)->name)" 
    field-name="name" 
    label-name="{{ __('qa_app::labels.name') }}"
/>
<div class="row">
    <div class="col-sm-12 col-md-6">
        <x-dc-input-field 
            type="number"
            step="0.05"
            min="0"
            max="1"
            :field-value="old('value', optional($question_option ?? null)->value)" 
            field-name="value" 
            label-name="{{ __('qa_app::labels.question_option_value') }}"
        />
    </div>
    <div class="col-sm-12 col-md-6">
        <x-dc-select-field
            :field-value="old('question_type_id', optional($question_option ?? null)->question_type_id)" 
            field-name="question_type_id" 
            label-name="{{ __('qa_app::labels.question_type') }}"
            :data-array="$questionTypesList"
        />
    </div>
</div>
