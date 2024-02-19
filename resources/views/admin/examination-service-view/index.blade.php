@extends('admin.layout.default')

@section('title', trans('admin.examination-service.actions.index'))

@section('body')

<div class="row">
    <div class="col-4">
        <div class="card">
            <call-patient-listing v-cloak inline-template>
                <div class="card-header">
                    <i class="fa fa-user"></i> Patient </span>
                    <button type="button" class="btn-primary btn-sm btn float-right"
                        @click.prevent="callPatient('{{$patientHistory->patient->user->name}}','lab')">Call
                        Pateint</button>
                </div>
            </call-patient-listing>
            <div class="card-body">
                @include('admin.examination-service-view.components.patient-info')
            </div>
        </div>
        <div class="card">
            @include('admin.examination-result.components.read-file.read-file',['upload'=>$upload,'status'=>'lab'])
        </div>
    </div>
    <div class="col-8">
        @include('admin.examination-service-view.components.form-input-examination-service',['data'=>$data,'patientHistoryId'=>$patientHistoryId])


    </div>
</div>

@endsection
