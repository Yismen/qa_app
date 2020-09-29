<div class="row">
    <div class="col-sm-12 col-lg-6">
        <x-dc-text-area
            :field-value="old('text', optional($question ?? null)->text)" 
            field-name="text" 
            rows="8"
            label-name="{{ __('qa_app::labels.question') }}"
        />
    </div>
    <div class="col-sm-12 col-lg-6">
        <x-dc-select-field
            :field-value="old('form_id', optional($question ?? null)->form_id)" 
            field-name="form_id" 
            label-name="{{ __('qa_app::labels.qa_form') }}"
            :data-array="$formsList"
        />
        <x-dc-input-field 
            type="number"
            step="1"
            min="0"
            max="100"
            :field-value="old('points', optional($question ?? null)->points)" 
            field-name="points" 
            label-name="{{ __('qa_app::labels.question_value') }}"
        />
        <x-dc-select-field
            :field-value="old('question_type_id', optional($question ?? null)->question_type_id)" 
            field-name="question_type_id" 
            label-name="{{ __('qa_app::labels.question_type') }}"
            :data-array="$questionTypesList"
        />
    </div>
</div>
