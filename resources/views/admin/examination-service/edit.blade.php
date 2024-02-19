@extends('admin.layout.default')

@section('title', trans('admin.examination-service.actions.edit', ['name' => $examinationService->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <examination-service-form
                :action="'{{ $examinationService->resource_url }}'"
                :data="{{ $examinationService->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.examination-service.actions.edit', ['name' => $examinationService->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.examination-service.components.form-elements')
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

        </examination-service-form>

        </div>

</div>

@endsection
