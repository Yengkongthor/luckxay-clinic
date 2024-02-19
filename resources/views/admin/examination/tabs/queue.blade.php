<examination-listing :data="{{ $data->toJson() }}" :url="'{{ url($url) }}'" inline-template v-cloak>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> {{ $header_name ?? '' }}
                    <form @submit.prevent="" class="float-right ">
                        <div class="row justify-content-md-between">
                            <div class="mb-0 col-sm-auto form-group">
                                <select class="form-control" v-model="pagination.state.per_page">

                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="100">100</option>
                                    <option value="1000">1000</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="p-0 card-body" v-cloak>
                    <div class="p-0 card-block">
                        <table class="table table-hover table-listing">
                            <thead>
                                <tr>

                                    {{-- <th is='sortable' :column="'id'">{{ trans('admin.queue.columns.id') }}</th> --}}
                                    <th>Queue</th>

                                    <th is='sortable' :column="'patient_id'">
                                        {{ trans('admin.queue.columns.patient_id') }}</th>


                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in collection" :key="item.id">


                                    <td><button class="btn btn-danger btn-lg">@{{ item.queue_number }}</button></td>
                                    <td>@{{ item.patient.user.full_name_phone }}</td>


                                    <td>

                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="pl-3 row" v-if="pagination.state.total > 0">
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
</examination-listing>
