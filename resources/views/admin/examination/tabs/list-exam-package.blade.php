<exam-package-listing :data="{{ $data->toJson() }}" :url="'{{ url('admin/exam-packages') }}'" inline-template>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> {{ trans('admin.exam-package.actions.index') }}

                </div>
                <div class="card-body" v-cloak>
                    <div class="card-block">


                        <table class="table table-hover table-listing">
                            <thead>
                                <tr>
                                    <th is='sortable' :column="'id'">{{ trans('admin.exam-package.columns.id') }}</th>
                                    <th is='sortable' :column="'id'">{{ __('Pateint') }}</th>
                                    <th is='sortable' :column="'package_id'">
                                        {{ trans('admin.exam-package.columns.package_id') }}</th>

                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in collection" :key="item.id">
                                    <td><button
                                            :class="item.patientHistory.status == 1 ? 'btn btn-success btn-lg':'btn btn-danger btn-lg'">@{{ item.id }}</button>
                                    </td>
                                    <td>@{{ item.patientHistory.patient.user.full_name_phone }}</td>
                                    <td>@{{ item.package ? item.package.name : '' }}</td>

                                    <td>
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <a class="btn btn-sm   btn-info" :href="item.resource_url + '/edit'"
                                                    title="{{ trans('brackets/admin-ui::admin.btn.edit') }}"
                                                    role="button"><i class="fa fa-edit"></i></a>
                                            </div>
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
</exam-package-listing>
