@extends('admin.layout.default')

@section('title', trans('admin.role.actions.create'))

@section('body')

<div class="container-xl">

    <div class="card">

        <role-form :action="'{{ url('admin/roles') }}'" v-cloak inline-template>

            <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action"
                novalidate>

                <div class="card-header">
                    <i class="fa fa-plus"></i> {{ trans('admin.role.actions.create') }}
                </div>

                <div class="card-body">
                    @include('admin.role.components.form-elements')
                </div>

                <div>
                    @include('admin.partials.save-button')
                    @include('admin.partials.back-button')
                </div>

            </form>

        </role-form>

    </div>

</div>


@endsection
