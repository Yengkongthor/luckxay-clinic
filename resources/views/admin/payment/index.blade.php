@extends('admin.layout.default')

@section('title', __('Payment'))

@section('body')

<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active show" data-toggle="tab" href="#paying" role="tab" aria-controls="paying"
            aria-selected="true">Paying</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#pay_already" role="tab" aria-controls="pay_already"
            aria-selected="false">Pay already</a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane active show" id="paying" role="tabpanel">
        @include('admin.payment.components.payment-element',['data'=>$data,'url'=>'admin/payments/payment'])
    </div>
    <div class="tab-pane" id="pay_already" role="tabpanel">
        @include('admin.payment.components.pay_already',['data'=>$payAlready,'url'=>'admin/payments/pay_already'])
    </div>

</div>



@endsection
