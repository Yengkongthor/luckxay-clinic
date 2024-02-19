@extends('admin.layout.default')

@section('title', __('Report'))

@section('body')

<report-form v-cloak inline-template :action="'#'">

    <div class="card">
        @include('admin.partials.modal.modal',['name'=>'report','body'=>view('admin.page-report.modals.summary')])
        <div class="card-header">
            <h1>Report</h1>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="{{ url('admin/reports/view-summary/lab') }}" class="text-dark">+
                        ສະຫຼຸບລາຍຮັບທີ່ເກີດຂື້ນໃນແຕ່ລະລາຍການໃນແຕ່ລະວັນ</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ url('admin/reports/view-summary/day') }}" class="text-dark">+
                        ສະຫຼຸບລາຍຮັບລວມໃນແຕ່ລະວັນ</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ url('admin/reports/view-summary/time') }}" class="text-dark">+
                        ສະຫຼຸບຈຳນວນຄົນທີ່ມາໃຊ້ບໍລິການຕາມຊ່ວງເວລາທີ່ມາໃຊ້ບໍລິການ</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ url('admin/reports/view-summary/gender') }}" class="text-dark">+
                        ສະຫຼຸບຈຳນວນຄົນທີ່ມາໃຊ້ບໍລິການຕາມອາຍູທຽບກັບເພດ</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ url('admin/reports/view-summary/province') }}" class="text-dark">+
                        ສະຫຼຸບຈຳນວນຄົນທີ່ມາໃຊ້ບໍລິການຕາມຂອບເຂດພື້ນທີ່</a>
                </li>

            </ul>
            <div class="row">

                {{-- <div class="col-sm-6 col-md-2">
                        @include('admin.partials.card.dashboard-card',[
                        'btn_name'=>'ລາຍງານສະຖິຕິຄົນເຈັບ',
                        'image'=>'images/icon-02.png', // TODO icon
                        'title'=>'ລາຍງານສະຖິຕິຄົນເຈັບ',
                        'url'=>'/admin/patient-statistics',
                        'short_desc'=>' ',
                        ])
                    </div>
                    <div class="col-sm-6 col-md-2">
                        @include('admin.partials.card.dashboard-card',[
                        'btn_name'=>'ລາຍງານ lab-x-ray-echos',
                        'image'=>'images/icon-02.png', // TODO icon
                        'title'=>'ລາຍງານ Lab X-ray-echos',
                        'url'=>'/admin/lab-xray-echos',
                        'short_desc'=>' ',
                        ])
                    </div>
                    <div class="col-sm-6 col-md-2">
                        @include('admin.partials.card.dashboard-card',[
                        'btn_name'=>'ລາຍງານ ກຳໄລ',
                        'image'=>'images/icon-02.png', // TODO icon
                        'title'=>'ລາຍງານ ກຳໄລ',
                        'url'=>'/admin/profits',
                        'short_desc'=>' ',
                        ])
                    </div>
                </div> --}}

            </div>
            <iframe v-if="print" :src="print" class="d-none"></iframe>
            <iframe v-if="printStock" :src="printStock" class="d-none"></iframe>
        </div>
</report-form>
@endsection
