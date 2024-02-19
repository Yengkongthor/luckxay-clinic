@extends('admin.layout.default')


@section('title', trans('admin.booking-time.actions.edit', ['name' => '']))

@section('body')

<div class="row">
    <div class="col-12">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active show" data-toggle="tab" href="#patient_info" role="tab"
                    aria-controls="patient_info" aria-selected="true">
                    </i> {{ __('Patient info')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link  show" data-toggle="tab" href="#observation" role="tab" aria-controls="observation"
                    aria-selected="true">
                    </i> {{ __('Observation')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link  show" data-toggle="tab" href="#examination" role="tab" aria-controls="home"
                    aria-selected="true">
                    </i> {{ __('Examination')}}</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#patient_history" role="tab" aria-controls="profile"
                    aria-selected="false">
                    </i> {{__('Patient History')}}</a>
            </li>
        </ul>
        <examination-form :action="'{{ url('admin/examinations') }}'" :services="{{$services->toJson()}}"
            :status-add-edit="'{{ app('request')->input('status') }}'" :data="{{ $examination->toJson() }}" v-cloak
            inline-template>
            <form class="form-horizontal form-edit" method="post" @submit.prevent="onSave" :action="action" novalidate>

                <div class="tab-content">

                    <div class="tab-pane active show" id="patient_info" role="tabpanel">
                        <call-patient-listing v-cloak inline-template>
                            <div class="card-header">{{ __('Patient')}}
                                <button type="button"
                                    @click.prevent="callPatient('{{$examination->patient->lao_first_name}}','examination')"
                                    class="btn btn-primary btn-sm float-right"> Call Patient</button>
                            </div>
                        </call-patient-listing>
                        <table style="width: 100%">
                            <tr>
                                <td>
                                    <img :src="data.patient.patient_logo" alt="" srcset="" width="150">

                                </td>
                                <td>
                                    <div class="col-6">
                                        Patient Id : @{{data.patient.patient_code}}
                                    </div>
                                    <div class="col-6">
                                        First Name : @{{data.patient.user.name}}
                                    </div>
                                    <div class="col-6">
                                        Last Name : @{{data.patient.user.surname}}
                                    </div>
                                    {{-- <div class="col-6">
                                        Nick name : @{{data.patient.nick_name}}
                                    </div> --}}
                                    <div class="col-6">
                                        Birth date : @{{data.patient.birth_date | date}}
                                    </div>

                                </td>
                                <td>
                                    <div class="col-6">
                                        Age : @{{data.patient.age}}
                                    </div>
                                    <div class="col-6">
                                        Gender : @{{data.patient.gender}}
                                    </div>

                                    <div class="col-6">
                                        Village : @{{data.patient.village}}
                                    </div>
                                    <div class="col-6">
                                        District : @{{data.patient.district}}
                                    </div>
                                    <div class="col-6">
                                        Province : @{{data.patient.province}}
                                    </div>
                                    <div class="col-6">
                                        Phone : @{{data.patient.user.phone}}
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="card-body">
                                <table class="table table-responsive-sm table-sm">
                                    <thead>
                                        <tr>
                                            <th>BP</th>
                                            <th>Pressure</th>
                                            <th>Temperature</th>
                                            <th>RR</th>
                                            <th>Spo2</th>
                                            <th>Weight</th>
                                            <th>ວັນທີ່ກວດ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item,index) in data.patient.basic_physical_examination">
                                            <td>@{{item.bp}}</td>
                                            <td>@{{item.pressure}}</td>
                                            <td>@{{item.temperature}}</td>
                                            <td>@{{item.rr}}</td>
                                            <td>@{{item.spo2}}</td>
                                            <td>@{{item.weight}}</td>
                                            <td>@{{item.created_at | date}}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div>
                                    <div class="card-header">
                                        {{ __('Comment')}}
                                    </div>
                                    <div class="card-body pl-0" v-cloak>
                                        <div class="card-block">
                                            <p>@{{form.comment | striphtml}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane  show" id="observation" role="tabpanel">
                        <div class="col">
                            @include('admin.examination.components.info-history')
                        </div>
                    </div>

                    <div class="tab-pane  show" id="examination" role="tabpanel">
                        <a class="btn btn-primary m-1" href="/admin/print-examination" target="_blank"> ພີມໃບສັງກວດ</a>
                        @include('admin.examination.components.examination-elements')
                    </div>



                    <div class="tab-pane" id="patient_history" role="tabpanel">
                        @include('admin.examination.components.patient_history')
                    </div>

                </div>
                {{-- <iframe :src="printExam" v-if="printExam" class="d-none"></iframe> --}}
            </form>
        </examination-form>
    </div>
</div>

@endsection
