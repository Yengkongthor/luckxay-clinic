@extends('admin.layout.default')

@section('title', trans('admin.prescribe-medicine.actions.index'))

@section('body')
<div class="row">

    <div class="col ">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#prescribe_medicines" role="tab"
                    aria-controls="prescribe_medicines">Prescribe Medicines</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#prescribe_medicine_package" role="tab"
                    aria-controls="profile">Prescribe Medicines Package</a>
            </li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="prescribe_medicines" role="tabpanel">
                @include('admin.prescribe-medicine.components.prescribe-medicine',['data'=>$data])
            </div>
            <div class="tab-pane" id="prescribe_medicine_package" role="tabpanel">

                @include('admin.prescribe-medicine.components.exam-package',['data'=>$dataExamPackage])
            </div>

        </div>
    </div>
</div>


@endsection
