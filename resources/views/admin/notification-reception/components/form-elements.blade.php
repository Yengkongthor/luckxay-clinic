<div class="form-group row align-items-center" :class="{'has-danger': errors.has('caller'), 'has-success': fields.caller && fields.caller.valid }">
    <label for="caller" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.notification-reception.columns.caller') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.caller" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('caller'), 'form-control-success': fields.caller && fields.caller.valid}" id="caller" name="caller" placeholder="{{ trans('admin.notification-reception.columns.caller') }}">
        <div v-if="errors.has('caller')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('caller') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('class'), 'has-success': fields.class && fields.class.valid }">
    <label for="class" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.notification-reception.columns.class') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.class" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('class'), 'form-control-success': fields.class && fields.class.valid}" id="class" name="class" placeholder="{{ trans('admin.notification-reception.columns.class') }}">
        <div v-if="errors.has('class')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('class') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('patient'), 'has-success': fields.patient && fields.patient.valid }">
    <label for="patient" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.notification-reception.columns.patient') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.patient" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('patient'), 'form-control-success': fields.patient && fields.patient.valid}" id="patient" name="patient" placeholder="{{ trans('admin.notification-reception.columns.patient') }}">
        <div v-if="errors.has('patient')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('patient') }}</div>
    </div>
</div>


