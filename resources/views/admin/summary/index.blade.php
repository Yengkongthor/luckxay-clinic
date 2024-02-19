@extends('admin.layout.default')

@section('title', trans('admin.summary.actions.index'))

@section('body')

<summary-listing :data="{{ $data->toJson() }}" :url="'{{ url('admin/summaries') }}'" inline-template v-cloak>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">

                        <div class="col">
                            <div class="form-group row">
                                <div class="col-4"><label class="col-form-label">From Date</label>
                                </div>
                                <div class="col-8"><label for="start_date">
                                        <datetime v-model="startDate" :config="datePickerConfig"
                                            v-validate="'date_format:yyyy-MM-d'" class="flatpickr" id="start_date"
                                            name="start_date" placeholder="From Date"></datetime>
                                    </label></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                                <div class="col-3"><label class="col-form-label">To Date</label></div>
                                <div class="col-9"><label for="end_date">
                                        <datetime v-model="endDate" :config="datePickerConfig"
                                            v-validate="'date_format:yyyy-MM-d'" class="flatpickr" id="end_date"
                                            name="end_date" placeholder="To Date"></datetime>
                                    </label></div>
                            </div>
                        </div>
                        <div class="col">
                            <button class="btn btn-sm btn-warning" type="button" @click.prevent="onView">
                                View</button>
                            {{-- <button class="btn btn-sm btn-success" type="button" @click.prevent="onPrint">
                                Print</button> --}}
                        </div>
                    </div>
                </div>

            </div>
            <div class="card">
                <div class="card-header">
                    <h4>ສະຫຼຸບປະຈຳວັນ/ເດືອນ</h4>
                </div>
                <div class="card-body " v-cloak>
                    <div class="card-block p-0">
                        <form @submit.prevent="">
                            <div class="row justify-content-md-between">
                                <div class="col col-lg-7 col-xl-5 form-group">
                                    {{-- <div class="input-group">
                                        <input class="form-control" placeholder="{{ trans('brackets/admin-ui::admin.placeholder.search') }}"
                                    v-model="search" @keyup.enter="filter('search', $event.target.value)" />
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-primary"
                                            @click="filter('search', search)"><i class="fa fa-search"></i>&nbsp;
                                            {{ trans('brackets/admin-ui::admin.btn.search') }}</button>
                                    </span>
                                </div> --}}
                            </div>
                            <div class="col-sm-auto form-group ">
                                <select class="form-control" v-model="pagination.state.per_page">

                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                    </div>
                    </form>

                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th>​ລ/ດ</th>
                                <th>ເລກທີບີນ </th>
                                <th>ຊື່ ແລະ ນາມສະກຸນລູກຄ້າ</th>
                                <th>ຈຳນວນເງີນທີ່ໄດ້ຮັບຕົວຈີງ </th>
                                <th>ອາກອນມູນຄ່າເພີ່ມ</th>
                                <th>ຈຳນວນເງີນຫຼັງລຸດເປີເຊັນ </th>
                                <th>ລວມຄ່າວິເຄາະ-ລັງສີ </th>
                                <th>ຄ່າບໍລິການ</th>
                                <th>ຄ່າຢາ</th>
                                <th>ລາຍຊື່ທ່ານໝໍຜູ້ກວດ </th>
                                <th>Date</th>
                                <th></th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in collection.summaries" :key="item.id">
                                <td>@{{ index + 1}}</td>
                                <td>L@{{item.id}}</td>
                                <td>@{{item.patient_history ? (item.patient_history.patient ? item.patient_history.patient.user.name : '') : ''}}
                                </td>
                                <td>
                                    @{{  item.price_total  - (((item.prescribe_medicine_charge ? item.prescribe_medicine_charge.discount_total_money : 0)/100)* item.price_total)  | formatNumber}}

                                </td>
                                <td>@{{item.prescribe_medicine_charge ? item.prescribe_medicine_charge.vat : ''}}
                                </td>
                                <td>
                                    @{{item.price_total | formatNumber}}
                                </td>
                                <td>@{{item.total_lab_detail | formatNumber}}</td>
                                <td>@{{(item.prescribe_medicine_charge ? item.prescribe_medicine_charge.charge  : 0) | formatNumber}}
                                    ຫລຸດ
                                    @{{item.prescribe_medicine_charge? item.prescribe_medicine_charge.discounted_services : 0}}%=@{{(item.prescribe_medicine_charge ? item.prescribe_medicine_charge.charge : 0) - ((item.prescribe_medicine_charge ? item.prescribe_medicine_charge.charge : 0)*(item.prescribe_medicine_charge? item.prescribe_medicine_charge.discounted_services : 0)/100) | formatNumber}}
                                </td>
                                <td>
                                    @{{item.total_medicine | formatNumber}}
                                    ຫລຸດ
                                    @{{item.prescribe_medicine_charge ? item.prescribe_medicine_charge.medicine_discount : 0}}
                                    %
                                    @{{item.total_medicine - ((item.prescribe_medicine_charge ? item.prescribe_medicine_charge.medicine_discount : 0)/100)*item.total_medicine | formatNumber}}
                                </td>
                                <td>@{{ item.employee_queue}}</td>
                                <td>@{{ item.date}}</td>
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

                    <div class="no-items-found" v-if="!collection.summaries.length > 0">
                        <i class="icon-magnifier"></i>
                        <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
                        <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>
                        {{-- <a class="btn btn-primary  " href="{{ url('admin/promotions/create') }}"
                        role="button"><i class="fa fa-plus"></i>&nbsp;
                        {{ trans('admin.promotion.actions.create') }}</a> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-responsive-sm ">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ຈຳນວນເງີນທີ່ໄດ້ຮັບຕົວຈີງ</th>
                            <th>ຈຳນວນເງີນຫຼັງລຸດເປີເຊັນ</th>
                            <th>ລວມຄ່າວິເຄາະ-ລັງສີ</th>
                            <th>ລວມຄ່າບໍລິການ</th>
                            <th>ລວມຄ່າຢາ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ລວມ</td>
                            <td>@{{collection.includeTheActualAmount}}</td>
                            <td>@{{collection.totalAfterPercentage}}</td>
                            <td>@{{collection.totalAnalysisValue}}</td>
                            <td>@{{collection.totalService}}</td>
                            <td>@{{collection.totalMedicines}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    <iframe :src="print" v-if="print" class="d-none"></iframe>

    </div>
    </div>

</summary-listing>

@endsection
