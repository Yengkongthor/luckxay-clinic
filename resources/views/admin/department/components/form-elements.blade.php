<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.department.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.department.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('department_code'), 'has-success': fields.department_code && fields.department_code.valid }">
    <label for="department_code" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.department.columns.department_code') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.department_code" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('department_code'), 'form-control-success': fields.department_code && fields.department_code.valid}" id="department_code" name="department_code" placeholder="{{ trans('admin.department.columns.department_code') }}">
        <div v-if="errors.has('department_code')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('department_code') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('department_phone'), 'has-success': fields.department_phone && fields.department_phone.valid }">
    <label for="department_phone" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.department.columns.department_phone') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.department_phone" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('department_phone'), 'form-control-success': fields.department_phone && fields.department_phone.valid}" id="department_phone" name="department_phone" placeholder="{{ trans('admin.department.columns.department_phone') }}">
        <div v-if="errors.has('department_phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('department_phone') }}</div>
    </div>
</div>


