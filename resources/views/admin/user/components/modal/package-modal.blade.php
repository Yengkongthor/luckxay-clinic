<div class="card-header">{{ __('Package')}} @{{full_name_phone}}</div>
<div class="card-body">
    <div class="form-group row">
        <div class="col col-form-label" v-for="(item,index) in collection.package">
            <div class="form-check form-check-inline mr-1">
                <input class="form-check-input" :id="index" type="radio" :value="item.id" :name="index"
                    v-model="packageId">
                <label class="form-check-label mb-0" :for="index">@{{item.name}}</label>
            </div>
        </div>
    </div>
</div>
<div class="card-footer">
    <button class="btn btn-sm btn-primary" type="button" v-if="!collection.package.lenght > 0" @click.prevent="onPackageExamination">
        <i class="fa fa-dot-circle-o"></i> ກວດ</button>
    <button class="btn btn-sm btn-danger" type="button" @click.prevent="hidePackage">
        Close
    </button>
</div>
