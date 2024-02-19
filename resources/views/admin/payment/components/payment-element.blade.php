<div class="row">
    <div class="col">
        <payment-listing :data="{{ $data->toJson() }}" :url="'{{ url($url) }}'" inline-template v-cloak>

            <div class="col">
                <div class="card">
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

                                        <th>{{__('Id')}}</th>
                                        <th>{{__('Patient')}}</th>

                                        <th></th>
                                    </tr>
                                    <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in collection" :key="item.id"
                                        :class="bulkItems[item.id] ? 'bg-bulk' : ''">

                                        <td>@{{item.queue_number}}</td>
                                        <td>@{{item.patient.user.full_name_phone}}</td>

                                        <td>
                                            <div class="row no-gutters">
                                                <div class="col-auto">
                                                    <a class="btn btn-sm btn-info"
                                                        :href="'/admin/payments/' + item.id +'/edit'"
                                                        title="{{ trans('brackets/admin-ui::admin.btn.edit') }}"
                                                        role="button"><i class="fa fa-edit"></i></a>
                                                </div>
                                                <form class="col" @submit.prevent="deleteItem(item.resource_url)">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </payment-listing>

    </div>
    <div class="col">
        <exam-package-listing :data="{{ $dataExamPackage->toJson() }}"
            :url="'{{ url('admin/payments/exam-packages') }}'" inline-template v-cloak>

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
                                    <td>@{{item.patientHistory.patient.user.name}}</td>
                                    <td>@{{ item.package.name }}</td>

                                    <td>
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <a class="btn btn-sm btn-info"
                                                    :href="'/admin/payments/' + item.id +'/edit-package'"
                                                    title="{{ trans('brackets/admin-ui::admin.btn.edit') }}"
                                                    role="button"><i class="fa fa-edit"></i></a>
                                            </div>
                                            {{-- <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                                <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i
                                                class="fa fa-trash-o"></i></button>
                                            </form> --}}
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
        </exam-package-listing>
    </div>
</div>
