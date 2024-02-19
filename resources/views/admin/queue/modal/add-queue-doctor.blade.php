<div class="card-header">
    {{__('Select Doctor')}}
</div>

<div class="card-body">
    {{-- <multiselect v-model="form.doctor" :options="{{$doctors->toJson()}}" :multiple="false" track-by="id"
    label="lao_full_name" tag-placeholder="{{ __('Select Doctor') }}" placeholder="{{ __('Doctor') }}">
    </multiselect> --}}

    <select class="custom-select custom-select-lg mb-3" v-model="form.doctor">
        <option v-for="(item,index) in {{$doctors->toJson()}}" :value="item.id">@{{item.lao_full_name}}</option>
    </select>

</div>


<div class="card-footer p-3">
    <button type="button" @click.prevent="onSave" class="btn btn-primary" v-if="form.doctor">
        {{ __('Assign') }}
    </button>
    <button type="button" class="btn btn-danger" @click.prevent="hide">
        {{ __('Close') }}
    </button>
</div>
