<div class="form-group row align-items-center" :class="{'has-danger': errors.has('last_date'), 'has-success': fields.last_date && fields.last_date.valid }">
    <label for="last_date" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.booking-date.columns.last_date') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.last_date" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('last_date'), 'form-control-success': fields.last_date && fields.last_date.valid}" id="last_date" name="last_date" placeholder="{{ trans('admin.booking-date.columns.last_date') }}">
        <div v-if="errors.has('last_date')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('last_date') }}</div>
    </div>
</div>


