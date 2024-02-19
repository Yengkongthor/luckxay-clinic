@extends('admin.layout.default')


@section('title', trans('admin.booking-time.actions.index',['name'=>'']))

@section('body')

<div>
    <div class="row">
        <booking-time-listing type="morning" :data="{{ $data_morning->toJson() }}"
            :url="'{{ url('admin/booking-times/morning') }}'" inline-template v-cloak>

            <div class="col-md-8">
                @include('admin.booking-time.components.lists', ['name' => 'Morning'])
            </div>

        </booking-time-listing>
        <booking-time-form type="morning" :action="'{{ url('admin/booking-times') }}'" v-cloak inline-template>

            <div class="col-md-4">
                <div class="card">

                    <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action"
                        novalidate>

                        <div class="card-header">
                            {{ trans('admin.booking-time.actions.index',['name'=>'Morning']) }}
                        </div>

                        <div class="card-body">
                            @include('admin.booking-time.components.form-elements-morning')
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" :disabled="submiting">
                                <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                                {{ trans('brackets/admin-ui::admin.btn.save') }}
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </booking-time-form>
    </div>


    <div class="row">
        <booking-time-listing type="afternoon" :data="{{ $data_afternoon->toJson() }}"
            :url="'{{ url('admin/booking-times/afternoon') }}'" inline-template v-cloak>

            <div class="col-md-8">
                @include('admin.booking-time.components.lists', ['name' => 'Afternoon'])
            </div>

        </booking-time-listing>
        <booking-time-form type="afternoon" :action="'{{ url('admin/booking-times') }}'" v-cloak inline-template>

            <div class="col-md-4">
                <div class="card">

                    <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action"
                        novalidate>

                        <div class="card-header">
                            {{ trans('admin.booking-time.actions.index',['name'=>'Afternoon']) }}
                        </div>

                        <div class="card-body">
                            @include('admin.booking-time.components.form-elements-afternoon')
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" :disabled="submiting">
                                <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                                {{ trans('brackets/admin-ui::admin.btn.save') }}
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </booking-time-form>
    </div>
</div>


@endsection