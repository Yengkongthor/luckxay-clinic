@extends('admin.layout.default')

@section('title', trans('admin.lab.actions.create'))

@section('body')

<div class="container-xl">

    <div class="card">

        <lab-form :action="'{{ url('admin/labs') }}'" v-cloak inline-template>

            <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action"
                novalidate>

                <div class="card-header">
                    <i class="fa fa-plus"></i> {{ trans('admin.lab.actions.create') }}
                </div>

                <div class="card-body">
                    @include('admin.lab.components.form-elements')
                </div>

                @include('admin.partials.save-button')
                @include('admin.partials.back-button')

            </form>

        </lab-form>

    </div>

</div>


@endsection
