@extends('admin.layout.default')

@section('title', __('Accounting'))

@section('body')
<div class="row ">
    <div class="col-sm-6 col-lg-2">
        @include('admin.partials.card.dashboard-card',[
        'btn_name'=>'Accounting',
        'image'=>'images/ConvertPNG-08.png',
        'title'=>'Accounting',
        'url'=>'/admin/summaries',
        'short_desc'=>' ',
        ])
    </div>

    <div class="col-sm-6 col-lg-2">
        @include('admin.partials.card.dashboard-card',[
        'btn_name'=>'History',
        'image'=>'images/ConvertPNG-09.png',
        'title'=>'History',
        'short_desc'=>' ',
        ])
    </div>

    <div class="col-sm-6 col-lg-2">
        @include('admin.partials.card.dashboard-card',[
        'btn_name'=>'Payment',
        'image'=>'images/icon-11.png',
        'title'=>'Payment',
        'url'=>'/admin/payments',
        'short_desc'=>' ',
        ])
    </div>

    <div class="col-sm-6 col-lg-2">
        @include('admin.partials.card.dashboard-card',[
        'btn_name'=>'Exchanges',
        'image'=>'images/icon-14.png',
        'title'=>'Exchanges',
        'url'=>'/admin/exchanges',
        'short_desc'=>' ',
        ])
    </div>
</div>
@endsection
