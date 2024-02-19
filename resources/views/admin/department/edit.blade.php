@extends('admin.layout.default')


@section('title', trans('admin.department.actions.edit', ['name' => $department->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <department-form
                :action="'{{ $department->resource_url }}'"
                :data="{{ $department->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.department.actions.edit', ['name' => $department->name]) }}
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
