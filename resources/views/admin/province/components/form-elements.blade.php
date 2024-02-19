<div class="form-group row align-items-center" :class="{'has-danger': errors.has('en_name'), 'has-success': fields.en_name && fields.en_name.valid }">
    <label for="en_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.province.columns.en_name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.en_name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('en_name'), 'form-control-success': fields.en_name && fields.en_name.valid}" id="en_name" name="en_name" placeholder="{{ trans('admin.province.columns.en_name') }}">
        <div v-if="errors.has('en_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('en_name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('la_name'), 'has-success': fields.la_name && fields.la_name.valid }">
    <label for="la_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.province.columns.la_name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.la_name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('la_name'), 'form-control-success': fields.la_name && fields.la_name.valid}" id="la_name" name="la_name" placeholder="{{ trans('admin.province.columns.la_name') }}">
        <div v-if="errors.has('la_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('la_name') }}</div>
    </div>
</div>


