@extends('admin.layout.default')

@section('title', trans('admin.user.actions.create'))

@section('body')

<div class="container-xl">


    <user-form :action="'{{ url('admin/users') }}'" :activation="!!'{{ $activation }}'" inline-template  v-cloak>

        <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action">
            @include('admin.user.components.form-elements')
            @include('admin.partials.save-button')
            @include('admin.partials.back-button')
        </form>
        
    </user-form>

</div>

@endsection
