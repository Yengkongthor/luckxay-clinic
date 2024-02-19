
<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('cheminal_name'), 'has-success': fields.cheminal_name && fields.cheminal_name.valid }">
    <label for="cheminal_name" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.medicine.columns.cheminal_name') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.cheminal_name" v-validate="'required'" @input="validate($event)"
            class="form-control"
            :class="{'form-control-danger': errors.has('cheminal_name'), 'form-control-success': fields.cheminal_name && fields.cheminal_name.valid}"
            id="cheminal_name" name="cheminal_name" placeholder="{{ trans('admin.medicine.columns.cheminal_name') }}">
        <div v-if="errors.has('cheminal_name')" class="form-control-feedback form-text" v-cloak>
            @{{ errors.first('cheminal_name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('dose'), 'has-success': fields.dose && fields.dose.valid }">
    <label for="dose" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.medicine.columns.dose') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.dose" v-validate="'required'" @input="validate($event)" class="form-control"
            :class="{'form-control-danger': errors.has('dose'), 'form-control-success': fields.dose && fields.dose.valid}"
            id="dose" name="dose" placeholder="{{ trans('admin.medicine.columns.dose') }}">
        <div v-if="errors.has('dose')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('dose') }}</div>
    </div>
</div>


<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('price'), 'has-success': fields.price && fields.price.valid }">
    <label for="price" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.medicine.columns.price') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.price" v-validate="'required|decimal'" @input="validate($event)"
            class="form-control"
            :class="{'form-control-danger': errors.has('price'), 'form-control-success': fields.price && fields.price.valid}"
            id="price" name="price" placeholder="{{ trans('admin.medicine.columns.price') }}">
        <div v-if="errors.has('price')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('price') }}
        </div>
    </div>
</div>


<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('min_amount'), 'has-success': fields.min_amount && fields.min_amount.valid }">
    <label for="min_amount" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.medicine.columns.min_amount') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.min_amount" v-validate="'required|decimal'" @input="validate($event)"
            class="form-control"
            :class="{'form-control-danger': errors.has('min_amount'), 'form-control-success': fields.min_amount && fields.min_amount.valid}"
            id="min_amount" name="min_amount" placeholder="{{ trans('admin.medicine.columns.min_amount') }}">
        <div v-if="errors.has('min_amount')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('min_amount') }}
        </div>
    </div>
</div>
