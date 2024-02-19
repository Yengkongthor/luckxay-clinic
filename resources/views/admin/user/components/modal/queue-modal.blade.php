<form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action">
    <div class="card-header">
        Patient : @{{full_name_phone}}
    </div>

    <div class="card-block">
        <div class="form-group row">
            <div class="col-md-12 col-form-label">
                <span class="mr-2">Type:</span>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="inline-radio1" type="radio" v-bind:value="1" v-model="form.important"
                       >
                    <label class="form-check-label mb-0" for="inline-radio1">ລູກຄ້າທົ່ວໄປ</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="inline-radio2" type="radio" v-bind:value="2" v-model="form.important"
                        >
                    <label class="form-check-label mb-0" for="inline-radio2">VIP</label>
                </div>
            </div>
        </div>
        <wysiwyg v-model="form.comment" v-validate="''" id="comment" name="comment" :config="mediaWysiwygConfig">
        </wysiwyg>
    </div>

    <div class="card-footer p-3">
        <button type="submit" class="btn btn-primary">
            <i class="fa" :class="submiting ? 'fa-spinner' : ''"></i>
            {{ __('Add to queue') }}
        </button>
    </div>
</form>
