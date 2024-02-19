<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.branch.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.branch.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('addres'), 'has-success': fields.addres && fields.addres.valid }">
    <label for="addres" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.branch.columns.addres') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.addres" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('addres'), 'form-control-success': fields.addres && fields.addres.valid}" id="addres" name="addres" placeholder="{{ trans('admin.branch.columns.addres') }}">
        <div v-if="errors.has('addres')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('addres') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('map'), 'has-success': fields.map && fields.map.valid }">
    <label for="map" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.branch.columns.map') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.map" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('map'), 'form-control-success': fields.map && fields.map.valid}" id="map" name="map" placeholder="{{ trans('admin.branch.columns.map') }}">
        <div v-if="errors.has('map')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('map') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('tel'), 'has-success': fields.tel && fields.tel.valid }">
    <label for="tel" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.branch.columns.tel') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.tel" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('tel'), 'form-control-success': fields.tel && fields.tel.valid}" id="tel" name="tel" placeholder="{{ trans('admin.branch.columns.tel') }}">
        <div v-if="errors.has('tel')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('tel') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('email'), 'has-success': fields.email && fields.email.valid }">
    <label for="email" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.branch.columns.email') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.email" v-validate="'required|email'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('email'), 'form-control-success': fields.email && fields.email.valid}" id="email" name="email" placeholder="{{ trans('admin.branch.columns.email') }}">
        <div v-if="errors.has('email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('email') }}</div>
    </div>
</div>


