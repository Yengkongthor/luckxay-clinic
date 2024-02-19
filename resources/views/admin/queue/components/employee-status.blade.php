<employee-status-listing :data="{{ $employeeDoctor->toJson() }}" :url="'{{ url('admin/queues/employee/doctor') }}'"
    inline-template v-cloak>
    <div class="card">
        <div class="card-header">
            {{ __('Doctors')}}
        </div>
        <div class="card-body p-0">
            <div class="card-block">


                <table class="table table-hover table-listing">
                    <thead>
                        <tr>
                            <th is='sortable' :column="'id'">{{ __('Class') }}</th>
                            <th is='sortable' :column="'doctor_id'">
                                {{ __('Doctor') }}</th>

                            <th></th>
                        </tr>

                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in collection" :key="item.id">

                            <td>
                                <button :class="item.assign == 0 ? 'btn btn-warning btn-lg' : 'btn btn-success btn-lg'">
                                    @{{ item.employee ? item.employee.employee_status.examination_class : '-' }}
                                </button>
                            </td>
                            <td>@{{ item.employee ? item.employee.lao_first_name : '' }}</td>
                            <td>@{{ item.assign == 0 ? 'ບໍ່ວ່າງ' : 'ວ່າງ' }}</td>
                            <td>
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
        <div class="card-footer"></div>
    </div>

</employee-status-listing>
