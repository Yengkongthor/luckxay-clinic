<patient-history-listing :data="{{ $data->toJson() }}" :url="'{{ url('admin/patient-histories') }}'" inline-template>

    <div class="row">
        @include('admin.partials.modal.modal',[
        'name'=>'patient-history-view',
        'width'=>'80%',
        'beforeOpen'=>'beforeOpen',
        'body'=>view('admin.examination.modal.modal-patient-view')
        ])
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> {{ trans('admin.patient-history.actions.index') }}
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


                                    <th is='sortable' :column="'test_at'">
                                        {{ trans('admin.patient-history.columns.test_at') }}</th>

                                    <th></th>
                                </tr>
                                <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                    <td class="bg-bulk-info d-table-cell text-center" colspan="7">
                                        <span
                                            class="align-middle font-weight-light text-dark">{{ trans('brackets/admin-ui::admin.listing.selected_items') }}
                                            @{{ clickedBulkItemsCount }}. <a href="#" class="text-primary"
                                                @click="onBulkItemsClickedAll('/admin/patient-histories')"
                                                v-if="(clickedBulkItemsCount < pagination.state.total)"> <i class="fa"
                                                    :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i>
                                                {{ trans('brackets/admin-ui::admin.listing.check_all_items') }}
                                                @{{ pagination.state.total }}</a> <span class="text-primary">|</span> <a
                                                href="#" class="text-primary"
                                                @click="onBulkItemsClickedAllUncheck()">{{ trans('brackets/admin-ui::admin.listing.uncheck_all_items') }}</a>
                                        </span>

                                        <span class="pull-right pr-2">
                                            <button class="btn btn-sm btn-danger pr-3 pl-3"
                                                @click="bulkDelete('/admin/patient-histories/bulk-destroy')">{{ trans('brackets/admin-ui::admin.btn.delete') }}</button>
                                        </span>

                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in collection" :key="item.id"
                                    :class="bulkItems[item.id] ? 'bg-bulk' : ''">


                                    <td>@{{ item.test_at | date }}</td>

                                    <td>
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <button class="btn btn-sm btn-info"
                                                    @click.prevent='showModalPatientHistoryView(item)'>
                                                    <i class="fa fa-eye"></i>
                                                </button>
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
</patient-history-listing>
