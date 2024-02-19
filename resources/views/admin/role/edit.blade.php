@extends('admin.layout.default')

@section('title', trans('admin.role.actions.edit', ['name' => $role->name]))

@section('body')

<div class="container-xl">


    <role-form :action="'{{ $role->resource_url }}'" :data="{{ $role->toJson() }}"
        :permissions="{{ $permissions->toJson() }}" v-cloak inline-template>

        <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>

            <div class="card">

                <div class="card-header">
                    <i class="fa fa-pencil"></i> {{ trans('admin.role.actions.edit', ['name' => $role->name]) }}
                </div>

                <div class="card-body">
                    @include('admin.role.components.form-elements')
                </div>


                <div>
                    @include('admin.partials.save-button')
                    @include('admin.partials.back-button', ['url' => route('admin/roles/index')])
                </div>

            </div>

            @include('admin.role.components.permissions')

        </form>

    </role-form>



</div>

@endsection
