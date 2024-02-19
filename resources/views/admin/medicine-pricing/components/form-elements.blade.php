
<div class="form-group row align-items-center"
:class="{'has-danger': errors.has('medicine_id'), 'has-success': fields.medicine_id && fields.medicine_id.valid }">
<label for="medicine_id" class="col-form-label text-md-right"
    :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.medicine-pricing.columns.medicine_id') }}</label>
<div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">

    <multiselect v-model="form.medicine" :options="medicines" :multiple="false" track-by="id" label="cheminal_name"
        tag-placeholder="{{ __('Select Medicine') }}" placeholder="{{ __('Medicine') }}">
    </multiselect>


    <div v-if="errors.has('medicine_id')" class="form-control-feedback form-text" v-cloak>
        @{{ errors.first('medicine_id') }}</div>
</div>
</div>

<div class="form-group row align-items-center"
:class="{'has-danger': errors.has('supplier_id'), 'has-success': fields.supplier_id && fields.supplier_id.valid }">
<label for="supplier_id" class="col-form-label text-md-right"
    :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.medicine-pricing.columns.supplier_id') }}</label>
<div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">

    <multiselect v-model="form.supplier" :options="suppliers" :multiple="false" track-by="id" label="name"
        tag-placeholder="{{ __('Select Supplier') }}" placeholder="{{ __('Supplier') }}">
    </multiselect>


    <div v-if="errors.has('supplier_id')" class="form-control-feedback form-text" v-cloak>
        @{{ errors.first('supplier_id') }}</div>
</div>
</div>


<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('amount'), 'has-success': fields.amount && fields.amount.valid }">
    <label for="amount" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.medicine-pricing.columns.amount') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.amount" v-validate="'required|integer'" @input="validate($event)"
            class="form-control"
            :class="{'form-control-danger': errors.has('amount'), 'form-control-success': fields.amount && fields.amount.valid}"
            id="amount" name="amount" placeholder="{{ trans('admin.medicine-pricing.columns.amount') }}">
        <div v-if="errors.has('amount')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('amount') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('base_price'), 'has-success': fields.base_price && fields.base_price.valid }">
    <label for="base_price" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.medicine-pricing.columns.base_price') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.base_price" v-validate="'required|decimal'" @input="validate($event)"
            class="form-control"
            :class="{'form-control-danger': errors.has('base_price'), 'form-control-success': fields.base_price && fields.base_price.valid}"
            id="base_price" name="base_price" placeholder="{{ trans('admin.medicine-pricing.columns.base_price') }}">
        <div v-if="errors.has('base_price')" class="form-control-feedback form-text" v-cloak>
            @{{ errors.first('base_price') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('best_before_date'), 'has-success': fields.best_before_date && fields.best_before_date.valid }">
    <label for="best_before_date" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.medicine-pricing.columns.best_before_date') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-sm-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.best_before_date" :config="datePickerConfig"
                 class="flatpickr"
                :class="{'form-control-danger': errors.has('best_before_date'), 'form-control-success': fields.best_before_date && fields.best_before_date.valid}"
                id="best_before_date" name="best_before_date"
                placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_date') }}"></datetime>
        </div>
        <div v-if="errors.has('best_before_date')" class="form-control-feedback form-text" v-cloak>
            @{{ errors.first('best_before_date') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('manufacture_date'), 'has-success': fields.manufacture_date && fields.manufacture_date.valid }">
    <label for="manufacture_date" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.medicine-pricing.columns.manufacture_date') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-sm-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.manufacture_date" :config="datePickerConfig"
                 class="flatpickr"
                :class="{'form-control-danger': errors.has('manufacture_date'), 'form-control-success': fields.manufacture_date && fields.manufacture_date.valid}"
                id="manufacture_date" name="manufacture_date"
                placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_date') }}"></datetime>
        </div>
        <div v-if="errors.has('manufacture_date')" class="form-control-feedback form-text" v-cloak>
            @{{ errors.first('manufacture_date') }}</div>
    </div>
</div>
