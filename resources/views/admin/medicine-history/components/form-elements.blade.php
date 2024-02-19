<div class="form-group row align-items-center" :class="{'has-danger': errors.has('medicine_id'), 'has-success': fields.medicine_id && fields.medicine_id.valid }">
    <label for="medicine_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.medicine-history.columns.medicine_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.medicine_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('medicine_id'), 'form-control-success': fields.medicine_id && fields.medicine_id.valid}" id="medicine_id" name="medicine_id" placeholder="{{ trans('admin.medicine-history.columns.medicine_id') }}">
        <div v-if="errors.has('medicine_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('medicine_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('cost'), 'has-success': fields.cost && fields.cost.valid }">
    <label for="cost" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.medicine-history.columns.cost') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.cost" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('cost'), 'form-control-success': fields.cost && fields.cost.valid}" id="cost" name="cost" placeholder="{{ trans('admin.medicine-history.columns.cost') }}">
        <div v-if="errors.has('cost')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('cost') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('price'), 'has-success': fields.price && fields.price.valid }">
    <label for="price" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.medicine-history.columns.price') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.price" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('price'), 'form-control-success': fields.price && fields.price.valid}" id="price" name="price" placeholder="{{ trans('admin.medicine-history.columns.price') }}">
        <div v-if="errors.has('price')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('price') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('status_approved'), 'has-success': fields.status_approved && fields.status_approved.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="status_approved" type="checkbox" v-model="form.status_approved" v-validate="''" data-vv-name="status_approved"  name="status_approved_fake_element">
        <label class="form-check-label" for="status_approved">
            {{ trans('admin.medicine-history.columns.status_approved') }}
        </label>
        <input type="hidden" name="status_approved" :value="form.status_approved">
        <div v-if="errors.has('status_approved')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('status_approved') }}</div>
    </div>
</div>


