@extends('admin.layout.default')

@section('title', trans('admin.profit.actions.index'))

@section('body')

<profit-listing :data="{{ $data->toJson() }}" :url="'{{ url('admin/profits') }}'" inline-template v-cloak>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> {{ trans('admin.profit.actions.index') }}
                </div>
                <div class="card-body" v-cloak>
                    <div class="card-block">
                        <form @submit.prevent="">
                            <div class="row justify-content-md-between">
                                <div class="col col-lg-7 col-xl-5 form-group">
                                    <div class="input-group">
                                        <input class="form-control"
                                            placeholder="{{ trans('brackets/admin-ui::admin.placeholder.search') }}"
                                            v-model="search" @keyup.enter="filter('search', $event.target.value)" />
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-primary"
                                                @click="filter('search', search)"><i class="fa fa-search"></i>&nbsp;
                                                {{ trans('brackets/admin-ui::admin.btn.search') }}</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <div class="input-group input-group--custom mr-2">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <datetime v-model="startDate" :config="datePickerConfig"
                                            v-validate="'date_format:yyyy-MM-dd'" class="flatpickr" id="startDate"
                                            name="startDate" placeholder="Select start date"></datetime>
                                    </div>
                                    <div class="input-group input-group--custom mr-2">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <datetime v-model="endDate" :config="datePickerConfig"
                                            v-validate="'date_format:yyyy-MM-dd'" class="flatpickr" id="endDate"
                                            name="endDate" placeholder="Select end date"></datetime>
                                    </div>
                                    <div class="input-group input-group--custom">
                                        <button class="btn btn-primary" @click.prevent="onView">View</button>
                                    </div>
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



                                    <th>ລຳດັບ</th>
                                    <th>ຊື່ ແລະ ນາມສະກຸນ</th>
                                    <th>ຈຳນວນເງິນທີໄດ້ຣັບຕົວຈິງ</th>
                                    <th>ລາຄາຢາຕົ້ນທຶນ</th>
                                    <th>ກຳໄລລາຄາຢາ</th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in collection.prescribeMedicineDetail" :key="item.id"
                                    :class="bulkItems[item.id] ? 'bg-bulk' : ''">
                                    <td>@{{index + 1}}</td>
                                    <td>@{{item.prescribe_medicine.patient_history.patient.user.full_name}}</td>
                                    <td>@{{item.lab_detail ? item.lab_detail.price : 0    }}</td>
                                    <td>@{{item.lab_detail ? item.lab_detail.cose : 0}}</td>
                                    <td>@{{(item.lab_detail ? item.lab_detail.price : 0) - (item.lab_detail ? item.lab_detail.cose : 0)}}
                                    </td>
                                    <td></td>
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

                        <div class="no-items-found" v-if="!collection.prescribeMedicineDetail.length > 0">
                            <i class="icon-magnifier"></i>
                            <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
                            <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <table>
                        <tr>
                            <td>
                                <h4>ລວມ: </h4>
                            </td>
                            <td><h4>@{{ collection.total | formatNumber}}</h4></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</profit-listing>

@endsection
