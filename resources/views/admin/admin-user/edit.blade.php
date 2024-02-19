@extends('admin.layout.default')

@section('title', trans('admin.admin-user.actions.edit', ['name' => $adminUser->first_name]))

@section('body')



<admin-user-form :action="'{{ $adminUser->resource_url }}'" :data="{{ $adminUser->toJson() }}"
    :activation="!!'{{ $activation }}'" inline-template v-cloak>

    <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action">
        <div class="row">
            <div class="col-md-6">
                <div class="card">

                    <div class="card-header">
                        <i class="fa fa-pencil"></i>
                        {{ trans('admin.admin-user.actions.edit', ['name' => $adminUser->first_name]) }}
                    </div>

                    <div class="card-body">

                        @include('admin.admin-user.components.form-elements')

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">

                    <div class="card-header">
                        <i class="fa fa-pencil"></i>
                        {{ trans('admin.admin-user.actions.edit', ['name' => $adminUser->roles]) }}
                    </div>

                    <div class="card-body">

                        @include('admin.admin-user.components.form-elements-employee')

                    </div>

                </div>
            </div>
        </div>


        @include('admin.partials.save-button')
        @include('admin.partials.back-button')

    </form>

</admin-user-form>



@endsection
