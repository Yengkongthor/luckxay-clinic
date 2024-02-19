@extends('admin.layout.default')

@section('title', trans('admin.admin-user.actions.create'))

@section('body')



<admin-user-form :action="'{{ url('admin/admin-users') }}'" :activation="!!'{{ $activation }}'" inline-template v-cloak>

    <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action">

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-plus"></i> {{ trans('admin.admin-user.actions.create') }}
                    </div>

                    <div class="card-body">

                        @include('admin.admin-user.components.form-elements')

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-plus"></i> {{ trans('admin.admin-user.actions.create') }}
                    </div>

                    <div class="card-body">

                        @include('admin.admin-user.components.form-elements-employee')

                    </div>
                </div>

            </div>
        </div>


        <div>
            @include('admin.partials.save-button')
            @include('admin.partials.back-button')
        </div>

    </form>

</admin-user-form>



@endsection
