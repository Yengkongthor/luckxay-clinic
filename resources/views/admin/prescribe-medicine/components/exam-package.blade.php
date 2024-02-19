<exam-package-listing :data="{{ $data->toJson() }}" :url="'{{ url('admin/exam-packages') }}'" inline-template>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> {{ trans('admin.exam-package.actions.index') }}

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
                                <div class="col-sm-auto form-group ">
                                    <select class="form-control" v-model="pagination.state.per_page">

                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                        </form>

                        <table class="table table-hover table-listing">
                            <thead>
                                <tr>


                                    <th is='sortable' :column="'id'">
                                        {{ trans('admin.exam-package.columns.id') }}</th>
                                    <th is='sortable' :column="'id'">{{ __('Pateint') }}</th>
                                    <th is='sortable' :column="'package_id'">
                                        {{ trans('admin.exam-package.columns.package_id') }}</th>


                                    <th></th>
                                </tr>
                                <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                    <td class="bg-bulk-info d-table-cell text-center" colspan="6">
                                        <span
                                            class="align-middle font-weight-light text-dark">{{ trans('brackets/admin-ui::admin.listing.selected_items') }}
                                            @{{ clickedBulkItemsCount }}. <a href="#" class="text-primary"
                                                @click="onBulkItemsClickedAll('/admin/exam-packages')"
                                                v-if="(clickedBulkItemsCount < pagination.state.total)">
                                                <i class="fa" :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i>
                                                {{ trans('brackets/admin-ui::admin.listing.check_all_items') }}
                                                @{{ pagination.state.total }}</a> <span class="text-primary">|</span> <a
                                                href="#" class="text-primary"
                                                @click="onBulkItemsClickedAllUncheck()">{{ trans('brackets/admin-ui::admin.listing.uncheck_all_items') }}</a>
                                        </span>

                                        <span class="pull-right pr-2">
                                            <button class="btn btn-sm btn-danger pr-3 pl-3"
                                                @click="bulkDelete('/admin/exam-packages/bulk-destroy')">{{ trans('brackets/admin-ui::admin.btn.delete') }}</button>
                                        </span>

                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in collection" :key="item.id">
                                    <td><button
                                            :class="item.patientHistory.status == 1 ? 'btn btn-success btn-lg':'btn btn-danger btn-lg'">@{{ item.id }}</button>
                                    </td>
                                    <td>@{{ item.patientHistory.patient.user.full_name_phone }}</td>
                                    <td>@{{ item.package.name }}</td>

                                    <td>
                                        <div class="row no-gutters">
                                            <a class="btn btn-sm   btn-info"
                                                :href="'/admin/prescribe-medicines/' + item.id +'/edit/exam-package'"
                                                title="{{ trans('brackets/admin-ui::admin.btn.edit') }}"
                                                role="button"><i class="fa fa-edit"></i></a>
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
                            {{-- <a class="btn btn-primary btn-spinner" href="{{ url('admin/exam-packages/create') }}"
                            role="button"><i class="fa fa-plus"></i>&nbsp;
                            {{ trans('admin.exam-package.actions.create') }}</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</exam-package-listing>
