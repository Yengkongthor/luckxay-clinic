@extends('admin.layout.default')

@section('title', trans('admin.patient-statistic.actions.index'))

@section('body')

<patient-statistic-listing :data="{{ $data->toJson() }}" :url="'{{ url('admin/patient-statistics') }}'" inline-template v-cloak>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> {{ trans('admin.patient-statistic.actions.index') }}
                    {{-- <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0"
                        href="{{ url('admin/patient-statistics/create') }}" role="button"><i
                            class="fa fa-plus"></i>&nbsp; {{ trans('admin.patient-statistic.actions.create') }}</a> --}}
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
                                    <th>#</th>
                                    <th>Patient Id</th>
                                    <th>ຊື່ ແລະ ນາມສະກຸນ</th>
                                    <th>ເພດ</th>
                                    <th>ບ້ານ</th>
                                    <th>ເມືອງ</th>
                                    <th>ແຂວງ</th>
                                    <th>ທ່າມໝໍ</th>
                                    <th>ວັນທີ</th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in collection" :key="item.id"
                                    :class="bulkItems[item.id] ? 'bg-bulk' : ''">

                                    <td> @{{index + 1}} </td>
                                    <td> @{{item.patient_history.patient.patient_code}}</td>
                                    <td> @{{item.patient_history.patient.user.full_name}}</td>
                                    <td> @{{item.patient_history.patient.gender == 'male' ? 'ຊາຍ' : 'ຍິງ'}}</td>
                                    <td> @{{item.patient_history.patient.village}}</td>
                                    <td> @{{item.patient_history.patient.district}}</td>
                                    <td> @{{item.patient_history.patient.province}}</td>
                                    <td> @{{item.employee_queue}}</td>
                                    <td> @{{item.date}}</td>
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
                            {{-- <a class="btn btn-primary btn-spinner" href="{{ url('admin/patient-statistics/create') }}"
                                role="button"><i class="fa fa-plus"></i>&nbsp;
                                {{ trans('admin.patient-statistic.actions.create') }}</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</patient-statistic-listing>

@endsection
