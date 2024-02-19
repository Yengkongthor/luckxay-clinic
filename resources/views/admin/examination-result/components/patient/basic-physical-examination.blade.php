<basic-physical-examination-listing :data="{{ $data->toJson() }}" :url="'{{ url($url) }}'" inline-template>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i>
                    {{ trans('admin.basic-physical-examination.actions.index') }}
                    <form @submit.prevent="" class="float-right">
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

                </div>
                <div class="card-body p-0" v-cloak>
                    <div class="card-block p-0">
                        <table class="table table-hover table-listing">
                            <thead>
                                <tr>

                                    <th is='sortable' :column="'pressure'">
                                        {{ trans('admin.basic-physical-examination.columns.pressure') }}
                                    </th>
                                    <th is='sortable' :column="'weight'">
                                        {{ trans('admin.basic-physical-examination.columns.weight') }}</th>
                                    <th is='sortable' :column="'temperature'">
                                        {{ trans('admin.basic-physical-examination.columns.temperature') }}
                                    </th>
                                    <th is='sortable' :column="'ta'">
                                        {{ trans('admin.basic-physical-examination.columns.ta') }}
                                    </th>
                                    <th is='sortable' :column="'spo2'">
                                        {{ trans('admin.basic-physical-examination.columns.spo2') }}
                                    </th>
                                    <th is='sortable' :column="'pr'">
                                        {{ trans('admin.basic-physical-examination.columns.pr') }}
                                    </th>
                                    <th is='sortable' :column="'test_at'">
                                        {{ __('Test At') }}
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in collection" :key="item.id">

                                    <td>@{{ item.pressure }}</td>
                                    <td>@{{ item.weight }}</td>
                                    <td>@{{ item.temperature }}</td>
                                    <td>@{{ item.ta }}</td>
                                    <td>@{{ item.spo2 }}</td>
                                    <td>@{{ item.pr }}</td>
                                    <td>@{{ item.created_at | datetime('DD.MM.YYYY, HH:mm')  }}</td>

                                    <td>

                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="row p-3" v-if="pagination.state.total > 0">
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
</basic-physical-examination-listing>
