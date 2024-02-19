@extends('admin.layout.default')

@section('title', trans('admin.lab-xray-echo.actions.edit', ['name' => $labXrayEcho->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <lab-xray-echo-form
                :action="'{{ $labXrayEcho->resource_url }}'"
                :data="{{ $labXrayEcho->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.lab-xray-echo.actions.edit', ['name' => $labXrayEcho->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.lab-xray-echo.components.form-elements')
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

        </lab-xray-echo-form>

        </div>

</div>

@endsection
