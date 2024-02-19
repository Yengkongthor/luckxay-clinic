@extends('admin.layout.default')

@section('title', trans('admin.user.actions.edit', ['name' => $user->name]))

@section('body')

<div class="container-xl">


    <user-form  :action="'{{ $user->resource_url }}'" :data="{{ $user->toJson() }}"
        :activation="!!'{{ $activation }}'" inline-template>

        <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action">

            @include('admin.user.components.form-elements')
            @include('admin.partials.save-button')
            @include('admin.partials.back-button')

        </form>


    </user-form>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-9">
            @include('admin.user.components.basic-physical-examination')

        </div>
    </div>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-9">
            @include('admin.user.components.patient-history',['data'=>$dataPatientHistory])

        </div>
    </div>


</div>

@endsection
