@extends('admin.layout.default')


@section('title', trans('admin.medicine.actions.create'))

@section('body')

<medicine-form :action="'{{ url('admin/medicines') }}'" :brands="{{$brands}}" :categories="{{$categories}}" v-cloak
    inline-template>

    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header">{{__('Brand')}}</div>
                <div class="card-body">
                    <multiselect v-model="form.brand" :options="brands" :multiple="false" track-by="id" label="name"
                        tag-placeholder="{{ __('Select Brand') }}" placeholder="{{ __('Brand') }}">
                    </multiselect>
                </div>
            </div>
            <div class="card">
                <div class="card-header">{{__('Category')}}</div>
                <div class="card-body">
                    <multiselect v-model="form.category" :options="categories" :multiple="false" track-by="id" label="name"
                        tag-placeholder="{{ __('Select Category') }}" placeholder="{{ __('Category') }}">
                    </multiselect>
                </div>
            </div>
        </div>
        <div class="col-8">

            <div class="card">


                <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action"
                    novalidate>

                    <div class="card-header">
                        <i class="fa fa-plus"></i> {{ trans('admin.medicine.actions.create') }}
                    </div>

                    <div class="card-body">
                        @include('admin.medicine.components.form-elements')
                    </div>

                    <div class="card-footer">
                        @include('admin.partials.save-button')
                    </div>

                </form>


            </div>
        </div>


    </div>

</medicine-form>

@endsection
