@extends('admin.layout.default')

@section('title', trans('admin.get-medicine.actions.index'))

@section('body')
<div class="row">
    <div class="col">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active show" data-toggle="tab" href="#get-medicine" role="tab"
                    aria-controls="get-medicine" aria-selected="true"> Get Medicines</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#finished" role="tab" aria-controls="finished"
                    aria-selected="false">Finished</a>
            </li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane active show" id="get-medicine" role="tabpanel">
                <div class="row">
                    @include('admin.get-medicine.components.get-medicine-element',['data'=>$data,'url'=>'admin/get-medicines/pay_already'])
                    @include('admin.get-medicine.components.get-medicine-element-package',['data'=>$dataExamPackage,'url'=>'admin/exam-packages/pay_already'])

                </div>
            </div>
            <div class="tab-pane" id="finished" role="tabpanel">
                <div class="row">
                    @include('admin.get-medicine.components.get-medicine-element',['data'=>$dataFinished,'url'=>'admin/get-medicines/finished'])
                    @include('admin.get-medicine.components.get-medicine-element-package',['data'=>$dataExamPackageFinished,'url'=>'admin/exam-packages/finished'])

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
