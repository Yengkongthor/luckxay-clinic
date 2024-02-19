<basic-physical-examination-listing :data="{{ $data->toJson() }}"
    :url="'{{ url('admin/basic-physical-examinations?patientId='.$user->patient->id) }}'" inline-template>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i>
                    {{ trans('admin.basic-physical-examination.actions.index') }}
                    <a class="btn btn-primary   btn-sm pull-right m-b-0"
                        href="{{ url('admin/basic-physical-examinations/create?patientId='.$user->patient->id) }}"
                        role="button"><i class="fa fa-plus"></i>&nbsp;
                        {{ trans('admin.basic-physical-examination.actions.create') }}</a>
                </div>
                <div class="card-body p-0" v-cloak>
                    <div class="card-block">
                        <table class="table table-hover table-listing">
                            <thead>
                                <tr>

                                    <th is='sortable' :column="'id'">
                                        {{ trans('admin.basic-physical-examination.columns.id') }}
                                    </th>

                                    <th is='sortable' :column="'pressure'">
                                        {{ trans('admin.basic-physical-examination.columns.pressure') }}
                                    </th>
                                    <th is='sortable' :column="'weight'">
                                        {{ trans('admin.basic-physical-examination.columns.weight') }}
                                    </th>
                                    <th is='sortable' :column="'temperature'">
                                        {{ trans('admin.basic-physical-examination.columns.temperature') }}
                                    </th>
                                    {{-- <th is='sortable' :column="'ta'">
                                        {{ trans('admin.basic-physical-examination.columns.ta') }} --}}
                                    </th>
                                    <th is='sortable' :column="'spo2'">
                                        {{ trans('admin.basic-physical-examination.columns.spo2') }}
                                    </th>
                                    {{-- <th is='sortable' :column="'pr'">
                                        {{ trans('admin.basic-physical-examination.columns.pr') }}
                                    </th> --}}
                                    <th is='sortable' :column="'pr'">
                                        {{ trans('admin.basic-physical-examination.columns.bp') }}
                                    </th>
                                    <th is='sortable' :column="'pr'">
                                        {{ trans('admin.basic-physical-examination.columns.rr') }}
                                    </th>

                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in collection" :key="item.id"
                                    :class="bulkItems[item.id] ? 'bg-bulk' : ''">


                                    <td>@{{ item.id }}</td>
                                    <td>@{{ item.pressure }}</td>
                                    <td>@{{ item.weight }}</td>
                                    <td>@{{ item.temperature }}</td>
                                    {{-- <td>@{{ item.ta }}</td> --}}
                                    <td>@{{ item.spo2 }}</td>
                                    {{-- <td>@{{ item.pr }}</td> --}}
                                    <td>@{{ item.bp }}</td>
                                    <td>@{{ item.rr }}</td>

                                    <td>
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <a class="btn btn-sm   btn-info"
                                                    :href="item.resource_url + '/edit'"
                                                    title="{{ trans('brackets/admin-ui::admin.btn.edit') }}"
                                                    role="button"><i class="fa fa-edit"></i></a>
                                            </div>
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
                            <a class="btn btn-primary  "
                                href="{{ url('admin/basic-physical-examinations/create?patientId='.$user->patient->id) }}"
                                role="button"><i class="fa fa-plus"></i>&nbsp;
                                {{ trans('admin.basic-physical-examination.actions.create') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</basic-physical-examination-listing>
