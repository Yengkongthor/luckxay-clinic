
<label for="comment" class="col-form-label text-md-right">Patient</label>

<multiselect v-model="form.patient" :options="patients" :multiple="false" track-by="patient.id" label="full_name_phone"
    tag-placeholder="{{ __('Select Patient') }}" placeholder="{{ __('Patient') }}">
</multiselect>

<label for="comment" class="col-form-label text-md-right">Comment</label>
<wysiwyg v-model="form.comment" v-validate="''" id="comment" name="comment" :config="mediaWysiwygConfig">
</wysiwyg>
