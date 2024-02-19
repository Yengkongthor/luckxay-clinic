@extends('admin.layout.default')

@section('title', trans('admin.medicine-pricing.actions.edit', ['name' => $medicinePricing->id]))

@section('body')

<div class="container-xl">
    <div class="card">

    <medicine-pricing-form :suppliers="{{$suppliers}}" :medicines="{{$medicines}}" :action="'{{ $medicinePricing->resource_url }}'"
            :data="{{ $medicinePricing->toJson() }}" v-cloak inline-template>

            <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action"
                novalidate>


                <div class="card-header">
                    <i class="fa fa-pencil"></i>
                    {{ trans('admin.medicine-pricing.actions.edit', ['name' => $medicinePricing->id]) }}
                </div>

                <div class="card-body">
                    @include('admin.medicine-pricing.components.form-elements')
                </div>


                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" :disabled="submiting">
                        <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                        {{ trans('brackets/admin-ui::admin.btn.save') }}
                    </button>
                </div>

            </form>

        </medicine-pricing-form>

    </div>

</div>

@endsection
