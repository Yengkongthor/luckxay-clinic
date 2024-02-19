@extends('admin.layout.default')

@section('title', trans('admin.basic-physical-examination.actions.edit', ['name' => $basicPhysicalExamination->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <basic-physical-examination-form
                :action="'{{ $basicPhysicalExamination->resource_url }}'"
                :data="{{ $basicPhysicalExamination->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.basic-physical-examination.actions.edit', ['name' => $basicPhysicalExamination->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.basic-physical-examination.components.form-elements')
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

        </basic-physical-examination-form>

        </div>

</div>

@endsection
