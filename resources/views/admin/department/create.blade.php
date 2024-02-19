@extends('admin.layout.default')


@section('title', trans('admin.department.actions.create'))

@section('body')

    <div class="container-xl">

                <div class="card">

        <department-form
            :action="'{{ url('admin/departments') }}'"
            v-cloak
            inline-template>

            <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action" novalidate>

                <div class="card-header">
                    <i class="fa fa-plus"></i> {{ trans('admin.department.actions.create') }}
                </div>

                <div class="card-body">
                    @include('admin.department.components.form-elements')
                </div>

                @include('admin.partials.save-button')
                @include('admin.partials.back-button')

            </form>

        </department-form>

        </div>

        </div>


@endsection
