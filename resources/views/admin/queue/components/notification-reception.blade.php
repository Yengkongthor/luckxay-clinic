<notification-reception-listing :data="{{ $data->toJson() }}" :url="'{{ url('admin/notification-receptions') }}'"
    inline-template>

    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('admin.notification-reception.actions.index') }}
        </div>
        <div class="card-body p-0" v-cloak>
            <div class="card-block">


                <table class="table table-hover table-listing">
                    <thead>
                        <tr>


                            <th is='sortable' :column="'caller'">
                                {{ trans('admin.notification-reception.columns.caller') }}</th>
                            <th is='sortable' :column="'class'">
                                {{ trans('admin.notification-reception.columns.class') }}</th>
                            <th is='sortable' :column="'patient'">
                                {{ trans('admin.notification-reception.columns.patient') }}</th>

                            <th></th>
                        </tr>

                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in collection" :key="item.id">


                            <td>@{{ item.caller }}</td>
                            <td>@{{ item.class }}</td>
                            <td>@{{ item.patient }}</td>

                            <td>
                                <div class="row no-gutters">

                                    <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                        <button type="submit" class="btn btn-sm btn-success"
                                            title="{{ trans('brackets/admin-ui::admin.btn.delete') }}">Finished</button>
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

</notification-reception-listing>
