@extends('admin.layout.default')


@section('title', trans('admin.patient-history.actions.create'))

@section('body')

<div class="container-xl">

    <div class="card">

        <patient-history-form :action="'{{ url('admin/patient-histories') }}'" v-cloak
            :patients="{{$patients->toJson()}}" inline-template>

            <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action"
                novalidate>

                <div class="card-header">
                    <i class="fa fa-plus"></i> {{ trans('admin.patient-history.actions.create') }}
                </div>

                <div class="card-body">
                    @include('admin.patient-history.components.form-elements')
                </div>

                @include('admin.partials.save-button')
                @include('admin.partials.back-button')

            </form>

        </patient-history-form>

    </div>

</div>


@endsection
