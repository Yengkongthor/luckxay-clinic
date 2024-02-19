@extends('admin.layout.default')

@section('title', __('Report'))

@section('body')

<div class="row">
    <div class="col-12">
        <lab-chart inline-template>
            <div class="card ">
                @if ($status != 'province' && $status != 'gender' )
                <div class="card-header">
                    <div class="d-flex flex-row">
                        <div>
                            <div class="form-group d-flex flex-row">
                                <div><label class="col-form-label mr-2">From Date</label>
                                </div>
                                <div><label for="start_date">
                                        <datetime v-model="fromDate" :config="datePickerConfig"
                                            v-validate="'date_format:yyyy-MM-d'" class="flatpickr mr-2" id="fromDate"
                                            name="fromDate" placeholder="From Date"></datetime>
                                    </label></div>
                            </div>
                        </div>
                        <div>
                            <div class="form-group d-flex flex-row ">
                                <div><label class="col-form-label mr-2 ml-2">to Date</label>
                                </div>
                                <div><label for="start_date">
                                        <datetime v-model="toDate" :config="datePickerConfig"
                                            v-validate="'date_format:yyyy-MM-d'" class="flatpickr" id="toDate"
                                            name="toDate" placeholder="To Date"></datetime>
                                    </label></div>
                            </div>
                        </div>

                        <div class=" ml-2">
                            <button class="btn  btn-warning" type="button" @click.prevent="onReview">
                                View</button>
                            <a class="btn  btn-success"
                                :href='"/admin/reports/download/excel?status={{$status}}&fromDate=" +fromDate + "&toDate=" + toDate'>
                                Export Excel</a>
                        </div>
                    </div>
                </div>
                @endif

                @if ($status == 'gender' || $status == 'province')
                <div class="card-header">
                    <div class="d-flex flex-row">
                        <div class=" ml-2">

                            <a class="btn  btn-success"
                                :href='"/admin/reports/download/excel?status={{$status}}&fromDate=" +fromDate + "&toDate=" + toDate'>
                                Export Excel</a>
                        </div>
                    </div>
                </div>
                @endif

                <div class="card-body ">
                    <div class="row ">
                        @if ($status == 'lab')
                        <div class="col">

                            <bar-chart :chart-data="datacollection" :options="options"></bar-chart>
                        </div>
                        @endif
                        @if ($status == 'day')
                        <div class="col">
                            <bar-chart :chart-data="datacollectionTotal" :options="options"></bar-chart>
                        </div>
                        @endif
                        @if ($status == 'time')
                        <div class="col">
                            <bar-chart :chart-data="datacollectionTime" :options="options"></bar-chart>
                        </div>
                        @endif
                        @if ($status == 'gender')
                        <div class="col-6">
                            <bar-chart :chart-data="datacollectionGenderMale" :options="options"></bar-chart>
                        </div>
                        <div class="col-6">
                            <bar-chart :chart-data="datacollectionGenderFemale" :options="options"></bar-chart>
                        </div>
                        @endif
                        @if ($status == 'province')
                        <div class="col">
                            <bar-chart :chart-data="datacollectionProvince" :options="options"></bar-chart>
                        </div>
                        @endif


                    </div>

                    @include('admin.partials.back-button')
                </div>
            </div>
        </lab-chart>
    </div>

</div>
@endsection
