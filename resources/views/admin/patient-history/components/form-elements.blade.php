<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('patient_id'), 'has-success': fields.patient_id && fields.patient_id.valid }">
    <label for="patient_id" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.patient-history.columns.patient_id') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">

        <multiselect v-model="form.patient" :options="patients" :multiple="false" track-by="id" label="lao_first_name"
            tag-placeholder="{{ __('Select Patient') }}" placeholder="{{ __('Select Patient') }}">
        </multiselect>


        <div v-if="errors.has('patient_id')" class="form-control-feedback form-text" v-cloak>
            @{{ errors.first('patient_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('weight'), 'has-success': fields.weight && fields.weight.valid }">
    <label for="weight" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.patient-history.columns.weight') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.weight" v-validate="'required|decimal'" @input="validate($event)"
            class="form-control"
            :class="{'form-control-danger': errors.has('weight'), 'form-control-success': fields.weight && fields.weight.valid}"
            id="weight" name="weight" placeholder="{{ trans('admin.patient-history.columns.weight') }}">
        <div v-if="errors.has('weight')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('weight') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('temperature'), 'has-success': fields.temperature && fields.temperature.valid }">
    <label for="temperature" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.patient-history.columns.temperature') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.temperature" v-validate="'required|decimal'" @input="validate($event)"
            class="form-control"
            :class="{'form-control-danger': errors.has('temperature'), 'form-control-success': fields.temperature && fields.temperature.valid}"
            id="temperature" name="temperature" placeholder="{{ trans('admin.patient-history.columns.temperature') }}">
        <div v-if="errors.has('temperature')" class="form-control-feedback form-text" v-cloak>
            @{{ errors.first('temperature') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('test_at'), 'has-success': fields.test_at && fields.test_at.valid }">
    <label for="test_at" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.patient-history.columns.test_at') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-sm-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.test_at" :config="datePickerConfig"
                v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr"
                :class="{'form-control-danger': errors.has('test_at'), 'form-control-success': fields.test_at && fields.test_at.valid}"
                id="test_at" name="test_at" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_date') }}">
            </datetime>
        </div>
        <div v-if="errors.has('test_at')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('test_at') }}
        </div>
    </div>
</div>
