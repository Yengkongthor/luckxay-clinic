@extends('admin.layout.default')

@section('title', __('Owner'))

@section('body')
<component-chart inline-template>
    {{-- <div class="card">
        <div class="card-header">
            <h1>ສະຫຼຸບ</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    {{-- <fusioncharts :type="type" :width="width" :height="height" :dataFormat="dataFormat"
                :dataSource="dataSourceSummary"></fusioncharts>
               <component-chart></component-chart>
                </div>
                <div class="col">
                    {{-- <fusioncharts :type="type" :width="width" :height="height" :dataFormat="dataFormat"
                :dataSource="patientStatistic"></fusioncharts>
                </div>
            </div>
        </div>
    </div> --}}
</component-chart>

<a href="{{url('/admin/reports')}}">
    <div class="card">
        <div class="card-header">
            <h1>ສະຫຼຸບ</h1>
        </div>
    </div>
</a>
<div class="card">
    <div class="card-header">
        <h1>Reception</h1>
    </div>
    <div class="card-body">
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
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h1>General Consulation</h1>
    </div>
    <div class="card-body">

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
    </div>
</div>


<div class="card">
    <div class="card-header">
        <h1>Pharmacy</h1>
    </div>
    <div class="card-body">
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
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h1>Accounting</h1>
    </div>
    <div class="card-body">
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
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h1>Lab department</h1>
    </div>
    <div class="card-body">
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
    </div>
</div>
@endsection
