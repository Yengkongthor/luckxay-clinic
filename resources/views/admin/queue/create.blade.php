@extends('admin.layout.default')

@section('title', trans('admin.queue.actions.create'))

@section('body')

<div class="container-xl">

    <div class="card">

        <queue-form :action="'{{ url('admin/queues') }}'" :patients="{{$patients->toJson()}}" v-cloak inline-template>

            <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action"
                novalidate>

                <div class="card-header">
                    <i class="fa fa-plus"></i> {{ trans('admin.queue.actions.create') }}
                    <a class="btn btn-primary   btn-sm pull-right m-b-0"
                        href="{{ url('admin/users/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp;
                        {{ __('New Patient') }}</a>

                </div>

                <div class="card-body">
                    @include('admin.queue.components.form-elements')
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" :disabled="submiting">
                        <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                        {{ trans('brackets/admin-ui::admin.btn.save') }}
                    </button>
                </div>

            </form>

        </queue-form>

    </div>

</div>


@endsection
