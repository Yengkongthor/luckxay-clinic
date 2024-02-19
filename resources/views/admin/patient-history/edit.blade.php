@extends('admin.layout.default')


@section('title', trans('admin.patient-history.actions.edit', ['name' => $patientHistory->id]))

@section('body')

<div class="container-xl">
    <div class="card">

        <patient-history-form :action="'{{ $patientHistory->resource_url }}'" :data="{{ $patientHistory->toJson() }}"
            :patients="{{$patients->toJson()}}" v-cloak inline-template>

            <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action"
                novalidate>


                <div class="card-header">
                    <i class="fa fa-pencil"></i>
                    {{ trans('admin.patient-history.actions.edit', ['name' => $patientHistory->id]) }}
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
