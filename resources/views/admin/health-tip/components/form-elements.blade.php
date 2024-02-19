<div class="form-group row align-items-center" :class="{'has-danger': errors.has('title'), 'has-success': fields.title && fields.title.valid }">
    <label for="title" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.health-tip.columns.title') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.title" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('title'), 'form-control-success': fields.title && fields.title.valid}" id="title" name="title" placeholder="{{ trans('admin.health-tip.columns.title') }}">
        <div v-if="errors.has('title')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('title') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('short_desc'), 'has-success': fields.short_desc && fields.short_desc.valid }">
    <label for="short_desc" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.health-tip.columns.short_desc') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.short_desc" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('short_desc'), 'form-control-success': fields.short_desc && fields.short_desc.valid}" id="short_desc" name="short_desc" placeholder="{{ trans('admin.health-tip.columns.short_desc') }}">
        <div v-if="errors.has('short_desc')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('short_desc') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('detail'), 'has-success': fields.detail && fields.detail.valid }">
    <label for="detail" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.health-tip.columns.detail') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>

            {{-- <textarea class="form-control" v-model="form.detail" v-validate="'required'" id="detail" name="detail"></textarea> --}}
            <wysiwyg v-model="form.detail" v-validate="'required'" id="detail" name="detail" :config="mediaWysiwygConfig" />

        </div>
        <div v-if="errors.has('detail')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('detail') }}</div>
    </div>
</div>


@if (isset($healthTip))
    @include('brackets/admin-ui::admin.includes.media-uploader', [
        'mediaCollection' => app(App\Models\HealthTip::class)->getMediaCollection('healthTips'),
        'media' => $healthTip->getThumbs200ForCollection('healthTips'),
        'label' => 'healthTips'
    ])
@else
@include('brackets/admin-ui::admin.includes.media-uploader', [
    'mediaCollection' => app(App\Models\HealthTip::class)->getMediaCollection('healthTips'),
    'label' => 'healthTips'
])
@endif




