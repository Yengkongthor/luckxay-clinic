<div class="form-group row align-items-center" :class="{'has-danger': errors.has('lab_id'), 'has-success': fields.lab_id && fields.lab_id.valid }">
    <label for="lab_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.upload.columns.lab_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.lab_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('lab_id'), 'form-control-success': fields.lab_id && fields.lab_id.valid}" id="lab_id" name="lab_id" placeholder="{{ trans('admin.upload.columns.lab_id') }}">
        <div v-if="errors.has('lab_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('lab_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('patient_history_id'), 'has-success': fields.patient_history_id && fields.patient_history_id.valid }">
    <label for="patient_history_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.upload.columns.patient_history_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.patient_history_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('patient_history_id'), 'form-control-success': fields.patient_history_id && fields.patient_history_id.valid}" id="patient_history_id" name="patient_history_id" placeholder="{{ trans('admin.upload.columns.patient_history_id') }}">
        <div v-if="errors.has('patient_history_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('patient_history_id') }}</div>
    </div>
</div>


