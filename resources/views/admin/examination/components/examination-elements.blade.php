<div class="card-columns">
    <p class="d-none">@{{i = 1}}</p>
    <div class="card" v-for="(service,index) in services">
        <div class="card-header"> <strong>@{{service.name}}</strong>
            <div class="btn-group btn-group-sm" role="group">
                <button type="button" class="btn btn-ghost-primary" @click.prevent="checkAll(service.id)">
                    <span class="fa fa-check-square"></span>
                </button>
                <button type="button" class="btn btn-ghost-primary" @click.prevent="unCheckAll(service.id)">
                    <span class="fa fa-minus-square"></span>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="form-check" v-for="(item,index) in service.lab_detail_service">
                    <input class="form-check-input" :id="service.name+'_'+item.id" type="checkbox"
                        :value="{ lab_detail_id: item.id,service_id: service.id,lab_id:item.lab_id }"
                        v-model="lab_detail">
                    <label class="form-check-label" :for="service.name+'_'+item.id">
                       @{{i}} .@{{item.name}}

                        <p class="d-none">@{{i++}}</p>
                    </label>
                </div>
            </div>
        </div>


    </div>


    @include('admin.partials.save-button',['name'=>'Send'])
    @include('admin.partials.back-button')
</div>

{{--
<div class="row">

    <div class="col">
        <div v-for="(service,index) in services">
            <label>
                <strong>@{{service.name}}</strong>
<div class="btn-group btn-group-sm" role="group">
    <button type="button" class="btn btn-ghost-primary" @click.prevent="checkAll(service.id)">
        <span class="fa fa-check-square"></span>
    </button>
    <button type="button" class="btn btn-ghost-primary" @click.prevent="unCheckAll(service.id)">
        <span class="fa fa-minus-square"></span>
    </button>
</div>
</label>
<div class="form-group row">
    <div class="form-check col-sm-4 col-md-3" v-for="(item,index) in service.lab_detail_service">
        <input class="form-check-input" :id="service.name+'_'+item.id" type="checkbox"
            :value="{ lab_detail_id: item.id,service_id: service.id,lab_id:item.lab_id }" v-model="lab_detail">
        <label class="form-check-label" :for="service.name+'_'+item.id">
            @{{item.name}}
        </label>
    </div>
</div>
</div>
</div>


@include('admin.partials.save-button',['name'=>'Send'])
@include('admin.partials.back-button')
</div> --}}
