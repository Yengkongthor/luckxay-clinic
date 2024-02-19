@extends('admin.layout.default')

@section('title', trans('admin.examination-service.actions.index'))

@section('body')
<div class="row">
    <div class="col">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active show" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">Examination</a>

            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                    aria-selected="false">Input Again
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active show" id="home" role="tabpanel">

                @include('admin.examination-service.components.examination-service-element',['data'=>$data_examination,'url'=>'admin/examination-services/examination'])

            </div>
            <div class="tab-pane" id="profile" role="tabpanel">

                @include('admin.examination-service.components.examination-service-element',['data'=>$data_input_again,'url'=>'admin/examination-services/input','input'=>'1'])
            </div>
        </div>
    </div>
</div>

@endsection
