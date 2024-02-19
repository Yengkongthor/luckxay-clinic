{{-- <div class="form-group row align-items-center" :class="{'has-danger': errors.has('lab_id'), 'has-success': fields.lab_id && fields.lab_id.valid }">
    <label for="lab_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.lab-detail.columns.lab_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.lab_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('lab_id'), 'form-control-success': fields.lab_id && fields.lab_id.valid}" id="lab_id" name="lab_id" placeholder="{{ trans('admin.lab-detail.columns.lab_id') }}">
        <div v-if="errors.has('lab_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('lab_id') }}</div>
    </div>
</div> --}}

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.lab-detail.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.lab-detail.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('unit'), 'has-success': fields.unit && fields.unit.valid }">
    <label for="unit" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.lab-detail.columns.unit') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.unit" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('unit'), 'form-control-success': fields.unit && fields.unit.valid}" id="unit" name="unit" placeholder="{{ trans('admin.lab-detail.columns.unit') }}">
        <div v-if="errors.has('unit')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('unit') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('reference'), 'has-success': fields.reference && fields.reference.valid }">
    <label for="reference" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.lab-detail.columns.reference') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.reference" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('reference'), 'form-control-success': fields.reference && fields.reference.valid}" id="reference" name="reference" placeholder="{{ trans('admin.lab-detail.columns.reference') }}">
        <div v-if="errors.has('reference')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('reference') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('cost'), 'has-success': fields.cost && fields.cost.valid }">
    <label for="cost" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.lab-detail.columns.cost') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.cost" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('cost'), 'form-control-success': fields.cost && fields.cost.valid}" id="cost" name="cost" placeholder="{{ trans('admin.lab-detail.columns.cost') }}">
        <div v-if="errors.has('cost')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('cost') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('price'), 'has-success': fields.price && fields.price.valid }">
    <label for="price" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.lab-detail.columns.price') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.price" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('price'), 'form-control-success': fields.price && fields.price.valid}" id="price" name="price" placeholder="{{ trans('admin.lab-detail.columns.price') }}">
        <div v-if="errors.has('price')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('price') }}</div>
    </div>
</div>


