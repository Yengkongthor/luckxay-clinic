@extends('admin.layout.default')

@section('title', trans('admin.booking-time.actions.create'))

@section('body')

<div class="container-xl">

    <div class="card">

        <booking-time-form :action="'{{ url('admin/booking-times') }}'" v-cloak inline-template>

            <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action"
                novalidate>

                <div class="card-header">
                    <i class="fa fa-plus"></i> {{ trans('admin.booking-time.actions.create') }}
                </div>

                <div class="card-body">
                    @include('admin.booking-time.components.form-elements')
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" :disabled="submiting">
                        <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                        {{ trans('brackets/admin-ui::admin.btn.save') }}
                    </button>
                </div>

            </form>

        </booking-time-form>

    </div>

</div>


@endsection
