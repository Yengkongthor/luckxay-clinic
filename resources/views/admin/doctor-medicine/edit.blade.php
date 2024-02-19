@extends('admin.layout.default')

@section('title', trans('admin.doctor-medicine.actions.edit', ['name' => $doctorMedicine->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <doctor-medicine-form
                :action="'{{ $doctorMedicine->resource_url }}'"
                :data="{{ $doctorMedicine->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.doctor-medicine.actions.edit', ['name' => $doctorMedicine->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.doctor-medicine.components.form-elements')
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

        </doctor-medicine-form>

        </div>

</div>

@endsection
