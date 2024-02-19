@extends('admin.layout.default')

@section('title', __('General Consulation'))

@section('body')
<div class="row ">

    <div class="col-sm-6 col-lg-2">
        @include('admin.partials.card.dashboard-card',[
        'btn_name'=>'Control',
        'image'=>'images/ConvertPNG-05.png',
        'title'=>'Examination',
        'url'=>'/admin/examinations',
        'short_desc'=>'',
        ])
    </div>

    <div class="col-sm-6 col-lg-2">
        @include('admin.partials.card.dashboard-card',[
        'btn_name'=>'Booking',
        'image'=>'images/ConvertPNG-03.png',
        'title'=>'Book an Appointment',
        'url'=>'/admin/book-an-appointments',
        'short_desc'=>' ',
        ])
    </div>

    <div class="col-sm-6 col-lg-2">
        @include('admin.partials.card.dashboard-card',[
        'btn_name'=>'Data Patient',
        'image'=>'images/ConvertPNG-04.png',
        'title'=>'Data Patient',
        'url'=>'/admin/users',
        'short_desc'=>' ',
        ])
    </div>


</div>
@endsection
