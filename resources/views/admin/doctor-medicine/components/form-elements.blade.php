{{-- <div class="form-group row align-items-center" :class="{'has-danger': errors.has('cheminal_name'), 'has-success': fields.cheminal_name && fields.cheminal_name.valid }">
    <label for="cheminal_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.doctor-medicine.columns.cheminal_name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.cheminal_name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('cheminal_name'), 'form-control-success': fields.cheminal_name && fields.cheminal_name.valid}" id="cheminal_name" name="cheminal_name" placeholder="{{ trans('admin.doctor-medicine.columns.cheminal_name') }}">
        <div v-if="errors.has('cheminal_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('cheminal_name') }}</div>
    </div>
</div> --}}


<div class="form-group row align-items-center" :class="{'has-danger': errors.has('amount'), 'has-success': fields.amount && fields.amount.valid }">
    <label for="amount" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.doctor-medicine.columns.amount') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.amount" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('amount'), 'form-control-success': fields.amount && fields.amount.valid}" id="amount" name="amount" placeholder="{{ trans('admin.doctor-medicine.columns.amount') }}">
        <div v-if="errors.has('amount')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('amount') }}</div>
    </div>
</div>


{{-- <div class="form-group row align-items-center" :class="{'has-danger': errors.has('patient_history_id'), 'has-success': fields.patient_history_id && fields.patient_history_id.valid }">
    <label for="patient_history_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.doctor-medicine.columns.patient_history_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.patient_history_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('patient_history_id'), 'form-control-success': fields.patient_history_id && fields.patient_history_id.valid}" id="patient_history_id" name="patient_history_id" placeholder="{{ trans('admin.doctor-medicine.columns.patient_history_id') }}">
        <div v-if="errors.has('patient_history_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('patient_history_id') }}</div>
    </div>
</div> --}}


