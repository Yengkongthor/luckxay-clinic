@extends('admin.layout.default')


@section('title', trans('admin.booking-date.actions.edit', ['name' => $bookingDate->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <booking-date-form
                :action="'{{ $bookingDate->resource_url }}'"
                :data="{{ $bookingDate->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.booking-date.actions.edit', ['name' => $bookingDate->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.booking-date.components.form-elements')
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

        </booking-date-form>

        </div>

</div>

@endsection
