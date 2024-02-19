@extends('admin.layout.default')

@section('title', trans('admin.queue.actions.index'))

@section('body')


<div class="row">
    <div class="col-8">

        @include('admin.queue.components.queue-element',['patientQueue'=>$patientQueue])
        @include('admin.queue.components.notification-reception',['data'=>$dataNotificationReception])

    </div>
    <div class="col-4">
        @include('admin.queue.components.employee-status',['employeeDoctor'=>$employeeDoctor])
    </div>


</div>


@endsection

