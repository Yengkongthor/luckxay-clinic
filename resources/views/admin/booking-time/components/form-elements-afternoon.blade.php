<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('start_time'), 'has-success': fields.start_time && fields.start_time.valid }">
    <label for="start_time" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.booking-time.columns.start_time') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
            <datetime v-model="form.start_time" :config="timePickerConfig" v-validate="'required|date_format:HH:mm:ss'"
                class="flatpickr"
                :class="{'form-control-danger': errors.has('start_time'), 'form-control-success': fields.start_time && fields.start_time.valid}"
                id="start_time_afternoon" name="start_time_afternoon"
                placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_time') }}"></datetime>
        </div>
        <div v-if="errors.has('start_time')" class="form-control-feedback form-text" v-cloak>
            @{{ errors.first('start_time') }}</div>
    </div>
</div>


<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('end_time'), 'has-success': fields.end_time && fields.end_time.valid }">
    <label for="end_time" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.booking-time.columns.end_time') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
            <datetime v-model="form.end_time" :config="timePickerConfig" v-validate="'required|date_format:HH:mm:ss'"
                class="flatpickr"
                :class="{'form-control-danger': errors.has('end_time'), 'form-control-success': fields.end_time && fields.end_time.valid}"
                id="end_time_afternoon" name="end_time_afternoon"
                placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_time') }}">
            </datetime>
        </div>
        <div v-if="errors.has('end_time')" class="form-control-feedback form-text" v-cloak>
            @{{ errors.first('end_time') }}</div>
    </div>
</div>
