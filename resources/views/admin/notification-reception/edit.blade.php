@extends('admin.layout.default')

@section('title', trans('admin.notification-reception.actions.edit', ['name' => $notificationReception->id]))

@section('body')

<div class="container-xl">
    <div class="card">

        <notification-reception-form :action="'{{ $notificationReception->resource_url }}'"
            :data="{{ $notificationReception->toJson() }}" v-cloak inline-template>

            <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action"
                novalidate>


                <div class="card-header">
                    <i class="fa fa-pencil"></i>
                    {{ trans('admin.notification-reception.actions.edit', ['name' => $notificationReception->id]) }}
                </div>

                <div class="card-body">
                    @include('admin.notification-reception.components.form-elements')
                </div>


                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" :disabled="submiting">
                        <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                        {{ trans('brackets/admin-ui::admin.btn.save') }}
                    </button>
                </div>

            </form>

        </notification-reception-form>

    </div>

</div>

@endsection
