@extends('admin.layout.default')


@section('title', trans('admin.booking-time.actions.edit', ['name' => $bookingTime->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <booking-time-form
                :action="'{{ $bookingTime->resource_url }}'"
                :data="{{ $bookingTime->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.booking-time.actions.edit', ['name' => $bookingTime->id]) }}
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
