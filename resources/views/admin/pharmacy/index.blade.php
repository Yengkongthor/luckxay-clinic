@extends('admin.layout.default')

@section('title', __('Pharmacy'))

@section('body')
<div class="row ">
    <div class="col-sm-6 col-lg-2">
        @include('admin.partials.card.dashboard-card',[
        'btn_name'=>'Pharmacy',
        'image'=>'images/ConvertPNG-10.png',
        'title'=>'Pharmacy',
        'url'=>'/admin/prescribe-medicines',
        'short_desc'=>' ',
        ])
    </div>

    <div class="col-sm-6 col-lg-2">
        @include('admin.partials.card.dashboard-card',[
        'btn_name'=>'Get medicine',
        'image'=>'images/icon-04.png',
        'title'=>'Get medicine',
        'url'=>'/admin/get-medicines',
        'short_desc'=>' ',
        ])
    </div>

    <div class="col-sm-6 col-lg-2">
        @include('admin.partials.card.dashboard-card',[
        'btn_name'=>'Stock',
        'image'=>'images/ConvertPNG-11.png',
        'title'=>'Stock',
        'url'=>'/admin/medicines',
        'short_desc'=>' ',
        ])
    </div>
    <div class="col-sm-6 col-lg-2">
        @include('admin.partials.card.dashboard-card',[
        'btn_name'=>'supplier',
        'image'=>'images/icon-06.png',
        'title'=>'Supplier',
        'url'=>'/admin/suppliers',
        'short_desc'=>' ',
        ])
    </div>
    <div class="col-sm-6 col-lg-2">
        @include('admin.partials.card.dashboard-card',[
        'btn_name'=>'Brand',
        'image'=>'images/icon-07.png',
        'title'=>'Brand',
        'url'=>'/admin/brands',
        'short_desc'=>' ',
        ])
    </div>
    <div class="col-sm-6 col-lg-2">
        @include('admin.partials.card.dashboard-card',[
        'btn_name'=>'Category',
        'image'=>'images/icon-08.png',
        'title'=>'Category',
        'url'=>'/admin/categories',
        'short_desc'=>' ',
        ])
    </div>

    <div class="col-sm-6 col-lg-2">
        @include('admin.partials.card.dashboard-card',[
        'btn_name'=>'Add medicine to stock',
        'image'=>'images/icon-10.png',
        'title'=>'Add medicine to stock',
        'url'=>'/admin/medicine-pricings',
        'short_desc'=>' ',
        ])
    </div>
</div>
@endsection
