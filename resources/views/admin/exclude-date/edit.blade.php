@extends('admin.layout.default')

@section('title', trans('admin.exclude-date.actions.edit', ['name' => $excludeDate->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <exclude-date-form
                :action="'{{ $excludeDate->resource_url }}'"
                :data="{{ $excludeDate->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.exclude-date.actions.edit', ['name' => $excludeDate->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.exclude-date.components.form-elements')
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

        </exclude-date-form>

        </div>

</div>

@endsection
