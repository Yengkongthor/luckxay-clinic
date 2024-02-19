<div class="form-group row align-items-center" :class="{'has-danger': errors.has('employee_id'), 'has-success': fields.employee_id && fields.employee_id.valid }">
    <label for="employee_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.employee-status.columns.employee_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.employee_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('employee_id'), 'form-control-success': fields.employee_id && fields.employee_id.valid}" id="employee_id" name="employee_id" placeholder="{{ trans('admin.employee-status.columns.employee_id') }}">
        <div v-if="errors.has('employee_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('employee_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('queue_id'), 'has-success': fields.queue_id && fields.queue_id.valid }">
    <label for="queue_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.employee-status.columns.queue_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.queue_id" v-validate="'integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('queue_id'), 'form-control-success': fields.queue_id && fields.queue_id.valid}" id="queue_id" name="queue_id" placeholder="{{ trans('admin.employee-status.columns.queue_id') }}">
        <div v-if="errors.has('queue_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('queue_id') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('status'), 'has-success': fields.status && fields.status.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="status" type="checkbox" v-model="form.status" v-validate="''" data-vv-name="status"  name="status_fake_element">
        <label class="form-check-label" for="status">
            {{ trans('admin.employee-status.columns.status') }}
        </label>
        <input type="hidden" name="status" :value="form.status">
        <div v-if="errors.has('status')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('status') }}</div>
    </div>
</div>


