<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('thb'), 'has-success': fields.thb && fields.thb.valid }">
    <label for="thb" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.exchange.columns.thb') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'" class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">฿</span></div>
        <input type="text" v-model="form.thb" v-validate="'required|decimal'" @input="validate($event)"
            class="form-control"
            :class="{'form-control-danger': errors.has('thb'), 'form-control-success': fields.thb && fields.thb.valid}"
            id="thb" name="thb" placeholder="{{ trans('admin.exchange.columns.thb') }}">
        <div v-if="errors.has('thb')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('thb') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('usd'), 'has-success': fields.usd && fields.usd.valid }">
    <label for="usd" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.exchange.columns.usd') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'"  class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">$</span></div>

        <input type="text" v-model="form.usd" v-validate="'required|decimal'" @input="validate($event)"
            class="form-control"
            :class="{'form-control-danger': errors.has('usd'), 'form-control-success': fields.usd && fields.usd.valid}"
            id="usd" name="usd" placeholder="{{ trans('admin.exchange.columns.usd') }}">
        <div v-if="errors.has('usd')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('usd') }}</div>
    </div>
</div>
