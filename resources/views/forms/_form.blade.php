<div class="row">
    <div class="col-sm-12 col-lg-8 col-xl-9">
        <x-dc-input-field 
            :field-value="old('name', optional($question_option ?? null)->name)" 
            field-name="name" 
            label-name="{{ __('qa_app::labels.name') }}"
        />
    </div>
    <div class="col-sm-12 col-lg-4 col-xl-3">
        <x-dc-input-field 
            type="number"
            step="0.05"
            min="0"
            max="1"
            :field-value="old('goal_percentage', optional($question_option ?? null)->goal_percentage)" 
            field-name="goal_percentage" 
            label-name="{{ __('qa_app::labels.passing_goal') }}"
        />
    </div>
</div>
