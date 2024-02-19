@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.employee-status.actions.edit', ['name' => $employeeStatus->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <employee-status-form
                :action="'{{ $employeeStatus->resource_url }}'"
                :data="{{ $employeeStatus->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.employee-status.actions.edit', ['name' => $employeeStatus->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.employee-status.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </employee-status-form>

        </div>
    
</div>

@endsection