<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.promotion.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.promotion.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('short_desc'), 'has-success': fields.short_desc && fields.short_desc.valid }">
    <label for="short_desc" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.promotion.columns.short_desc') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.short_desc" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('short_desc'), 'form-control-success': fields.short_desc && fields.short_desc.valid}" id="short_desc" name="short_desc" placeholder="{{ trans('admin.promotion.columns.short_desc') }}">
        <div v-if="errors.has('short_desc')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('short_desc') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('link'), 'has-success': fields.link && fields.link.valid }">
    <label for="link" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.promotion.columns.link') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.link" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('link'), 'form-control-success': fields.link && fields.link.valid}" id="link" name="link" placeholder="{{ trans('admin.promotion.columns.link') }}">
        <div v-if="errors.has('link')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('link') }}</div>
    </div>
</div>

@if (isset($promotion))
    @include('brackets/admin-ui::admin.includes.media-uploader', [
        'mediaCollection' => app(App\Models\Promotion::class)->getMediaCollection('promotion'),
        'media' => $promotion->getThumbs200ForCollection('promotion'),
        'label' => 'pomotion'
    ])
@else
    @include('brackets/admin-ui::admin.includes.media-uploader', [
        'mediaCollection' => app(App\Models\Promotion::class)->getMediaCollection('promotion'),
        'label' => 'promotion'
    ])
@endif

