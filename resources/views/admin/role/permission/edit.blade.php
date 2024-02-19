@extends('admin.layout.default')

@section('title', trans('admin.permission.actions.edit', ['name' => $permission->name]))

@section('body')

<div class="container-xl">
    <div class="card">

        <permission-form :action="'{{ $permission->resource_url }}'" :data="{{ $permission->toJson() }}" v-cloak
            inline-template>

            <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action"
                novalidate>


                <div class="card-header">
                    <i class="fa fa-pencil"></i>
                    {{ trans('admin.permission.actions.edit', ['name' => $permission->name]) }}
                </div>

                <div class="card-body">
                    @include('admin.permission.components.form-elements')
                </div>


                <div>
                    @include('admin.partials.save-button')
                    @include('admin.partials.back-button')
                </div>

            </form>

        </permission-form>

    </div>

</div>

@endsection
