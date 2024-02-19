@extends('admin.layout.default')

@section('title', trans('admin.examination.actions.index'))

@section('body')
<div class="row">
    <div class="col">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#list" role="tab" aria-controls="home">
                    {{ __('Lists')}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#pacakge" role="tab" aria-controls="profile">
                    {{ __('Package')}}
                    {{-- <span class="badge badge-pill badge-danger">{{$exam_package_wait_count}}</span> --}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#queue" role="tab" aria-controls="profile">
                    {{ __('Queues')}}
                    {{-- <span class="badge badge-pill badge-danger">{{$wait_count}}</span> --}}
                </a>
            </li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="list" role="tabpanel">
                <div class="card">
                    <employee-status-listing :assign="{{$assign}}" :data="{{ $data->toJson() }}"
                        :url="'{{ url('admin/employee-statuses') }}'" inline-template v-cloak>
                        <div class="card-header">
                            <div class="float-right d-flex align-items-center">
                                <span class="mr-2 pb-2">{{ __('Allow Assign') }}:</span>
                                <label class="switch switch-3d switch-success">
                                    <input type="checkbox" class="switch-input" value="0" v-model="form.assign"
                                        @change="allowAssign('{{auth()->user()->employee ? auth()->user()->employee->id : ''}}')">
                                    <span class="switch-slider"></span>
                                </label>
                            </div>
                        </div>
                    </employee-status-listing>
                    <div class="card-body">
                        <div class="row">
                            @include('admin.examination.tabs.list',['data'=>$data,'url'=>'/admin/examinations/processing','header_name'=>'Processing'])
                            @include('admin.examination.tabs.list-examination',['data'=>$dataExamination,'url'=>'/admin/examinations/examination','header_name'=>'Examination'])
                            @include('admin.examination.tabs.list-examination-result',['data'=>$dataExaminationResult,'url'=>'/admin/examinations/examination_result','header_name'=>'Examination
                            Result'])
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane" id="pacakge" role="tabpanel">
                @include('admin.examination.tabs.list-exam-package',['data'=>$dataExamPackage])

            </div>
            <div class="tab-pane" id="queue" role="tabpanel">
                @include('admin.examination.tabs.queue',['data'=>$dataWait,'url'=>'/admin/examinations/wait','header_name'=>'Queue'])
            </div>

        </div>
    </div>
</div>

@endsection
