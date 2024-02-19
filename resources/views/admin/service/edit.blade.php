@extends('admin.layout.default')

@section('title', trans('admin.service.actions.edit', ['name' => $service['name']]))

@section('body')


<service-form :action="'{{ $service['resource_url'] }}'" :labs="{{$labs->toJson()}}" :data="{{ json_encode($service) }}"
    v-cloak inline-template>

    <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>



        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-plus"></i> {{ trans('admin.service.actions.create') }}
                    </div>

                    <div class="card-body">
                        @include('admin.service.components.form-elements')
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-plus"></i> {{ __('Lab Details') }}
                    </div>

                    <div class="card-body">
                        @include('admin.service.components.form-lab-detail-elements')
                    </div>
                </div>
            </div>
        </div>

        @include('admin.partials.save-button')
        @include('admin.partials.back-button')

    </form>

</service-form>



@endsection
