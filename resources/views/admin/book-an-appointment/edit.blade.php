@extends('admin.layout.default')


@section('title', trans('admin.book-an-appointment.actions.edit', ['name' => $bookAnAppointment->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <book-an-appointment-form
                :action="'{{ $bookAnAppointment->resource_url }}'"
                :data="{{ $bookAnAppointment->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.book-an-appointment.actions.edit', ['name' => $bookAnAppointment->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.book-an-appointment.components.form-elements')
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

        </book-an-appointment-form>

        </div>

</div>

@endsection
