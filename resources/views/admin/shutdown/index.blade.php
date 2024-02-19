@extends('admin.layout.default')

@section('title', __('Shutdown System'))

@section('body')

<div class="container-xl">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <shutdown-form :action="'{{ url('admin/shutdown') }}'" :data="{{ $data->toJson() }}" v-cloak
                inline-template>
                <div class="card">

                    <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action"
                        novalidate>

                        <div class="card-header">
                            <i class="fa fa-pencil"></i>
                            {{ __('Shutdown System') }}
                        </div>

                        <div class="card-body d-flex justify-content-center">
                            <div class="d-flex align-items-center">
                                <span class="mr-2">{{ __('Shutdown') }}:</span>
                                <label class="switch switch-3d switch-success">
                                    <input type="checkbox" class="switch-input" value="1" v-model="form.shutdown"
                                        @change="toggleSwitch">
                                    <span class="switch-slider"></span>
                                </label>
                            </div>
                        </div>

                    </form>

                </div>
            </shutdown-form>

        </div>
    </div>
</div>

@endsection