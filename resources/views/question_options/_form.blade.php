<x-dc-input-field 
    :field-value="old('name', optional($question_option ?? null)->name)" 
    field-name="name" 
    label-name="Name:"
/>
<x-dc-input-field 
    type="number"
    step="0.05"
    min="0"
    max="1"
    :field-value="old('value', optional($question_option ?? null)->value)" 
    field-name="value" 
    label-name="Question Value:"
/>

<x-dc-select-field
    :field-value="old('question_type_id', optional($question_option ?? null)->question_type_id)" 
    field-name="question_type_id" 
    label-name="Question Type:"
    data-array="{!! $questionTypesList !!}"
/>