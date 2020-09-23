{{-- <div class="row">
    <div class="col-sm-12 col-lg-6">
        <x-dc-text-area
            :field-value="old('text', optional($audit ?? null)->text)" 
            field-name="text" 
            rows="8"
            label-name="Audit:"
        />
    </div>
    <div class="col-sm-12 col-lg-6">
        <x-dc-select-field
            :field-value="old('form_id', optional($audit ?? null)->form_id)" 
            field-name="form_id" 
            label-name="QA Form:"
            :data-array="$formsList"
        />
        <x-dc-input-field 
            type="number"
            step="1"
            min="0"
            max="100"
            :field-value="old('points', optional($audit ?? null)->points)" 
            field-name="points" 
            label-name="Audit Value:"
        />
        <x-dc-select-field
            :field-value="old('audit_type_id', optional($audit ?? null)->audit_type_id)" 
            field-name="audit_type_id" 
            label-name="Audit Type:"
            :data-array="$auditTypesList"
        />
    </div>
</div> --}}
