<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('bp'), 'has-success': fields.bp && fields.bp.valid }">
    <p for="bp" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.basic-physical-examination.columns.bp') }}</p>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.bp" v-validate="'required'" @input="validate($event)" class="form-control"
            :class="{'form-control-danger': errors.has('bp'), 'form-control-success': fields.bp && fields.bp.valid}"
            id="bp" name="bp" placeholder="{{ trans('admin.basic-physical-examination.columns.bp') }}">
        <div v-if="errors.has('bp')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('bp') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('pressure'), 'has-success': fields.pressure && fields.pressure.valid }">
    <p for="pressure" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.basic-physical-examination.columns.pressure') }}</p>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.pressure" v-validate="'required'" @input="validate($event)"
            class="form-control"
            :class="{'form-control-danger': errors.has('pressure'), 'form-control-success': fields.pressure && fields.pressure.valid}"
            id="pressure" name="pressure"
            placeholder="{{ trans('admin.basic-physical-examination.columns.pressure') }}">
        <div v-if="errors.has('pressure')" class="form-control-feedback form-text" v-cloak>
            @{{ errors.first('pressure') }}</div>
    </div>
</div>


<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('temperature'), 'has-success': fields.temperature && fields.temperature.valid }">
    <p for="temperature" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.basic-physical-examination.columns.temperature') }}</p>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.temperature" v-validate="'required'" @input="validate($event)"
            class="form-control"
            :class="{'form-control-danger': errors.has('temperature'), 'form-control-success': fields.temperature && fields.temperature.valid}"
            id="temperature" name="temperature"
            placeholder="{{ trans('admin.basic-physical-examination.columns.temperature') }}">
        <div v-if="errors.has('temperature')" class="form-control-feedback form-text" v-cloak>
            @{{ errors.first('temperature') }}</div>
    </div>
</div>


<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('rr'), 'has-success': fields.rr && fields.rr.valid }">
    <p for="rr" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.basic-physical-examination.columns.rr') }}</p>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.rr" v-validate="'required'" @input="validate($event)" class="form-control"
            :class="{'form-control-danger': errors.has('rr'), 'form-control-success': fields.rr && fields.rr.valid}"
            id="rr" name="rr" placeholder="{{ trans('admin.basic-physical-examination.columns.rr') }}">
        <div v-if="errors.has('rr')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('rr') }}</div>
    </div>
</div>


<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('spo2'), 'has-success': fields.spo2 && fields.spo2.valid }">
    <p for="spo2" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.basic-physical-examination.columns.spo2') }}</p>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.spo2" v-validate="'required'" @input="validate($event)" class="form-control"
            :class="{'form-control-danger': errors.has('spo2'), 'form-control-success': fields.spo2 && fields.spo2.valid}"
            id="spo2" name="spo2" placeholder="{{ trans('admin.basic-physical-examination.columns.spo2') }}">
        <div v-if="errors.has('spo2')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('spo2') }}</div>
    </div>
</div>



<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('weight'), 'has-success': fields.weight && fields.weight.valid }">
    <p for="weight" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.basic-physical-examination.columns.weight') }}</p>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.weight" v-validate="'required'" @input="validate($event)" class="form-control"
            :class="{'form-control-danger': errors.has('weight'), 'form-control-success': fields.weight && fields.weight.valid}"
            id="weight" name="weight" placeholder="{{ trans('admin.basic-physical-examination.columns.weight') }}">
        <div v-if="errors.has('weight')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('weight') }}
        </div>
    </div>
</div>



{{-- <div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('ta'), 'has-success': fields.ta && fields.ta.valid }">
    <label for="ta" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.basic-physical-examination.columns.ta') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.ta" v-validate="'required'" @input="validate($event)" class="form-control"
            :class="{'form-control-danger': errors.has('ta'), 'form-control-success': fields.ta && fields.ta.valid}"
            id="ta" name="ta" placeholder="{{ trans('admin.basic-physical-examination.columns.ta') }}">
        <div v-if="errors.has('ta')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('ta') }}</div>
    </div>
</div>



<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('pr'), 'has-success': fields.pr && fields.pr.valid }">
    <label for="pr" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.basic-physical-examination.columns.pr') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.pr" v-validate="'required'" @input="validate($event)" class="form-control"
            :class="{'form-control-danger': errors.has('pr'), 'form-control-success': fields.pr && fields.pr.valid}"
            id="pr" name="pr" placeholder="{{ trans('admin.basic-physical-examination.columns.pr') }}">
        <div v-if="errors.has('pr')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('pr') }}</div>
    </div>
</div> --}}
