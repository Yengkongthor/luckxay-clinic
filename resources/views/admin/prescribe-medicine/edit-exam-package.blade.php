@extends('admin.layout.default')

@section('title', trans('admin.queue.actions.edit'))

@section('body')


<div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <label for="note">Medicine</label>
                    <ul class="list-group">
                        @foreach ($doctorMedicines as $item)
                        <li class="list-group-item">ຊື່: {{$item->cheminal_name}} ຈຳນວນ: {{$item->amount}}</li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-6">

            @include('admin.prescribe-medicine.components.medicine',['data'=>$dataMedicine,'url'=>'/admin/prescribe-medicines/medicines'])
        </div>
        <div class="col-6">
            @include('admin.prescribe-medicine.components.shopping-cart',['data'=>$datashoppingCart,'url'=>'/admin/prescribe-medicines/shopping-cart','queueId'=> $examPackage->id,'status'=>'package','noMedicine'=>$doctorMedicines->count()])
        </div>
    </div>


</div>

@endsection
