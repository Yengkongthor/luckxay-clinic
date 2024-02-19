<div class="form-group row align-items-center" :class="{'has-danger': errors.has('employee_id'), 'has-success': fields.employee_id && fields.employee_id.valid }">
    <label for="employee_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.exam-package.columns.employee_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.employee_id" v-validate="'integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('employee_id'), 'form-control-success': fields.employee_id && fields.employee_id.valid}" id="employee_id" name="employee_id" placeholder="{{ trans('admin.exam-package.columns.employee_id') }}">
        <div v-if="errors.has('employee_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('employee_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('package_id'), 'has-success': fields.package_id && fields.package_id.valid }">
    <label for="package_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.exam-package.columns.package_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.package_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('package_id'), 'form-control-success': fields.package_id && fields.package_id.valid}" id="package_id" name="package_id" placeholder="{{ trans('admin.exam-package.columns.package_id') }}">
        <div v-if="errors.has('package_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('package_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('status'), 'has-success': fields.status && fields.status.valid }">
    <label for="status" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.exam-package.columns.status') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.status" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('status'), 'form-control-success': fields.status && fields.status.valid}" id="status" name="status" placeholder="{{ trans('admin.exam-package.columns.status') }}">
        <div v-if="errors.has('status')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('status') }}</div>
    </div>
</div>


