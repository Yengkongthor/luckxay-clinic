@extends('admin.layout.default')

@section('title', trans('admin.examination-result.actions.index'))

@section('body')

<div>
    <div class="row">
        <div class="col-5">

            <div class="card">
                <call-patient-listing v-cloak inline-template>
                    <div class="card-header">{{ __('Patient')}}
                        <button type="button"
                            @click.prevent="callPatient('{{$examinationResult->patient_history_last->patient->lao_first_name}}','examination_result')"
                            class="btn btn-primary btn-sm float-right"> Call Patient</button>
                    </div>
                </call-patient-listing>
                <examination-result-form :action="'{{ $examinationResult->resource_url }}'"
                    :data="{{ $examinationResult->toJson() }}" v-cloak inline-template>
                    <div class="card-body">

                        @include('admin.examination-result.components.patient.info')
                    </div>
                </examination-result-form>

            </div>

            @include('admin.examination-result.components.patient.basic-physical-examination',['data'=>$dataBasicPhysicalExamination,'url'=>'/admin/examination-results/basic/physical/examination'])

            @include('admin.examination-result.components.read-file.read-file',['upload'=>$upload])

            <info-data v-cloak inline-template :info="{{$informationHistoryDetail}}">
                <div class=" card">
                    <div class="card-header">{{ __('Luckxay clinic patient observation')}}</div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-sm">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item,index) in info">
                                    <td>@{{titleCase(item.key)}}</td>
                                    <td>
                                        <p>@{{item.value == 1 ? 'Yes' : item.value | striphtml}}</p>
                                    </td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </info-data>

        </div>
        <div class="col-7">
            <examination-result-form :action="'{{ $examinationResult->resource_url }}'"
                :data="{{ $examinationResult->toJson() }}" v-cloak inline-template>
                <div class="card">
                    <div class="card-header">
                        {{__('Examination Result')}}

                        <button type="button" @click.prevent="printExaminationResult({{$examinationResult->id}})"
                            class="btn btn-primary btn-sm float-right">Print Examination
                            Result</button>
                        <button type="button" @click.prevent="printPaientInfo({{$examinationResult->id}})"
                            class="btn btn-primary btn-sm float-right mr-2">Print Patient Info</button>


                    </div>
                    <div class="card-body">
                        <div v-for="(item,index) in this.groupData">
                            <h3>@{{item.groupName}}</h3>
                            <table class="table table-responsive-sm table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Lab</th>
                                        <th>Lab Detail</th>
                                        <th>Unit</th>
                                        <th>Reference</th>
                                        <th>Value Examination</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item,index) in item.data">
                                        <td>@{{item.lab.name}}</td>
                                        <td>@{{item.lab_detail.name}}</td>
                                        <td>@{{item.lab_detail.unit}}</td>
                                        <td>@{{item.lab_detail.reference}}</td>
                                        <td>@{{item.value}}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm float-right mr-1"
                                                @click.prevent="inputAgain(item.id)">Input again
                                            </button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <iframe v-if="print" :src="print" class="d-none"></iframe>

                </div>
            </examination-result-form>


            <examination-result-form :queue-id="{{$examinationResult->id}}"
                :action="'{{ url('admin/examination-results') }}'" v-cloak inline-template>
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action"
                    novalidate>

                    <div class="card">

                        <div class="card-header">
                            <i class="fa fa-pencil"></i>
                            {{ __('Examination Rusult Comment') }}
                        </div>
                        <div class="card-body">
                            {{-- <textarea class="form-control" v-model="form.body" id="exampleFormControlTextarea1"
                                rows="3"></textarea> --}}
                            <quill-editor v-model="form.body" :options="wysiwygConfig" />

                        </div>
                    </div>
                    <div class="card">

                        <div class="card-header">
                            <i class="fa fa-pencil"></i>
                            {{ __('Doctor Fee') }}
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <p for="doctor_fee">Doctor Fee</p>
                                <input class="form-control" id="doctor_fee" type="number" v-model="form.doctor_fee"
                                    placeholder="Doctor Fee">
                            </div>
                            <div class="form-group">
                                <p for="doctor_fee_discount">Doctor Fee Discount (%)</p>
                                <input class="form-control" id="doctor_fee_discount" type="number"
                                    v-model="form.doctor_fee_discount" placeholder="Doctor Fee Discount ">
                            </div>

                        </div>



                    </div>

                    @include('admin.partials.save-button')

                </form>
            </examination-result-form>


            <doctor-medicine-listing :data="{{ $data->toJson() }}" :examination-result="{{$examinationResult}}"
                :medicines="{{$medicines}}"
                :url="'{{ url('admin/examination-results/doctor-medicine/'.$examinationResult->patient_history_last->id) }}'"
                inline-template>

                <div class="row">
                    @include('admin.partials.modal.modal',['name'=>'doctor-medicine','body'=>view('admin.examination-result.components.modals.doctor-medicine')])
                    <div class="col">
                        <div class="card">
                            <div class="card-header">

                                <button class="btn btn-primary btn-sm float-right ml-5" @click.prevent="show"
                                    v-if="statusDoctorMedicine != 0"><i class="fa fa-plus"></i>&nbsp;Add
                                    Medicine</button>
                                <div class="float-left d-flex align-items-center ">
                                    <span class="mr-2">{{ __('ບໍ່ມີຢາ') }}:</span>
                                    <label class="switch switch-3d switch-success">
                                        <input type="checkbox" class="switch-input" value="1"
                                            v-model="statusDoctorMedicine" @change="toggleSwitch">
                                        <span class="switch-slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="card-body" v-cloak v-if="statusDoctorMedicine != 0">
                                <div class="card-block">
                                    <form @submit.prevent="">
                                        <div class="row justify-content-md-between">
                                            <div class="col-sm-auto form-group ">
                                                <select class="form-control" v-model="pagination.state.per_page">

                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>

                                    <table class="table table-hover table-listing">
                                        <thead>
                                            <tr>
                                                <th is='sortable' :column="'id'">
                                                    {{ trans('admin.doctor-medicine.columns.id') }}</th>
                                                <th is='sortable' :column="'amount'">
                                                    {{ trans('admin.doctor-medicine.columns.amount') }}</th>
                                                <th is='sortable' :column="'cheminal_name'">
                                                    {{ trans('admin.doctor-medicine.columns.cheminal_name') }}</th>

                                                <th>ຊະນິດ</th>
                                                <th>Dose</th>
                                                <th>ກິນ</th>
                                                <th></th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, index) in collection" :key="item.id">

                                                <td>@{{ item.id }}</td>

                                                <td>@{{ item.amount }}</td>
                                                <td>@{{ item.cheminal_name }}</td>
                                                <td>@{{ item.type }}</td>
                                                <td>@{{ item.dose }}</td>
                                                <td>@{{ item.use }}</td>

                                                <td>
                                                    <div class="row no-gutters">

                                                        <form class="col"
                                                            @submit.prevent="deleteItem(item.resource_url)">
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i
                                                                    class="fa fa-trash-o"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="row" v-if="pagination.state.total > 0">
                                        <div class="col-sm">
                                            <span
                                                class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>
                                        </div>
                                        <div class="col-sm-auto">
                                            <pagination></pagination>
                                        </div>
                                    </div>

                                    <div class="no-items-found" v-if="!collection.length > 0">
                                        <i class="icon-magnifier"></i>
                                        <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
                                        <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </doctor-medicine-listing>
        </div>
    </div>
</div>

@endsection
