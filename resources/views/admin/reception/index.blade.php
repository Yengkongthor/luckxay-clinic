@extends('admin.layout.default')

@section('title', __('Reception Home'))

@section('body')
<div class="row ">
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

    <div class="col-sm-6 col-lg-2">
        @include('admin.partials.card.dashboard-card',[
        'btn_name'=>'Queue',
        'image'=>'images/icon-01.png',
        'title'=>'Queue',
        'url'=>'/admin/queues',
        'short_desc'=>' ',
        ])
    </div>

    <div class="col-sm-6 col-lg-2">
        @include('admin.partials.card.dashboard-card',[
        'btn_name'=>'Package Result',
        'image'=>'images/icon-03.png',
        'title'=>'Package Result',
        'url'=>'/admin/exam-packages',
        'short_desc'=>' ',
        ])
    </div>

    <div class="col-sm-6 col-lg-2">
        @include('admin.partials.card.dashboard-card',[
        'btn_name'=>'Wage',
        'image'=>'images/icon-02.png',
        'title'=>'Wage',
        'url'=>'/admin/wages',
        'short_desc'=>' ',
        ])
    </div>

</div>
@endsection
