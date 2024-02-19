@extends('admin.layout.default')

@section('title', trans('admin.lab-xray-echo.actions.index'))

@section('body')

<lab-xray-echo-listing :data="{{ $data->toJson() }}" :url="'{{ url('admin/lab-xray-echos') }}'" inline-template v-cloak>
    <div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.lab-xray-echo.actions.index') }}
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
                                        <th>ລະດັບ</th>
                                        <th>ຊື່ ແລະ ນາມສະກຸນ</th>
                                        <th>ເພດ</th>
                                        <th>ລາຍງານກວດ</th>
                                        <th>ລາຄາ</th>
                                        <th>ທ່າມໝໍ</th>


                                        <th></th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in collection.PrescribeMedicineDetail" :key="item.id">

                                        <td>@{{index +1 }}</td>

                                        <td>@{{item.prescribe_medicine.patient_history.patient.user.full_name}}</td>
                                        <td> @{{item.prescribe_medicine.patient_history.patient.gender == 'male' ? 'ຊາຍ' : 'ຍິງ'}}
                                        </td>
                                        <td>@{{item.name}}</td>
                                        <td>@{{item.price}}</td>
                                        <td> @{{item.prescribe_medicine.employee_queue}}
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

                            <div class="no-items-found" v-if="!collection.PrescribeMedicineDetail.length > 0">
                                <i class="icon-magnifier"></i>
                                <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
                                <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">

                            <tbody>
                                <tr>
                                    <td colspan="5">
                                        <h3 class="text-right">ລວມທັງຫມົດ : </h3>
                                    </td>
                                    <td><h3>@{{collection.total | formatNumber}}</h3></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</lab-xray-echo-listing>

@endsection
