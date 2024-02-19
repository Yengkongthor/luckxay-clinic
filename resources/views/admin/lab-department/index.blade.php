@extends('admin.layout.default')

@section('title', __('Lab department'))

@section('body')
<div class="row ">
    <div class="col-sm-6 col-lg-2">
        @include('admin.partials.card.dashboard-card',[
        'btn_name'=>'Lab',
        'image'=>'images/icon-12.png',
        'title'=>'Lab',
        'url'=>'/admin/labs',
        'short_desc'=>' ',
        ])
    </div>


    <div class="col-sm-6 col-lg-2">
        @include('admin.partials.card.dashboard-card',[
        'btn_name'=>'Service',
        'image'=>'images/ConvertPNG-07.png',
        'title'=>'Service',
        'url'=>'/admin/services',
        'short_desc'=>' ',
        ])
    </div>

    <div class="col-sm-6 col-lg-2">
        @include('admin.partials.card.dashboard-card',[
        'btn_name'=>'Package',
        'image'=>'images/ConvertPNG-07.png',
        'title'=>'Package',
        'url'=>'/admin/packages',
        'short_desc'=>' ',
        ])
    </div>

    <div class="col-sm-6 col-lg-2">
        @include('admin.partials.card.dashboard-card',[
        'btn_name'=>'Examination Lab',
        'image'=>'images/ConvertPNG-07.png',
        'title'=>'Examination Lab',
        'url'=>'/admin/examination-services',
        'short_desc'=>' ',
        ])
    </div>
</div>
@endsection
