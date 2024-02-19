<queue-listing :data="{{ $patientQueue->toJson() }}" :url="'{{ url('admin/queues/patient') }}'" inline-template v-cloak>

    <div class="card">
        @include('admin.partials.modal.modal',['name'=>'add-queue-doctor','beforeOpen'=>'beforeOpen','body'=>view('admin.queue.modal.add-queue-doctor',['doctors'=>$dataEmployeeStatus])])

        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('admin.queue.actions.index') }}

        </div>
        <div class="card-body">
            <div class="card-block">
                <form @submit.prevent="">
                    <div class="row justify-content-md-between">
                        <div class="col col-lg-7 col-xl-5 form-group">
                            <div class="input-group">
                                <input class="form-control"
                                    placeholder="{{ trans('brackets/admin-ui::admin.placeholder.search') }}"
                                    v-model="search" @keyup.enter="filter('search', $event.target.value)" />
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-primary" @click="filter('search', search)"><i
                                            class="fa fa-search"></i>&nbsp;
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
                            <th class="bulk-checkbox">

                                Queue
                            </th>

                            <th is='sortable' :column="'patient_id'">
                                {{ __('Patient Id') }}</th>
                            <th is='sortable' :column="'patient_id'">
                                {{ trans('admin.queue.columns.patient_id') }}</th>
                            <th is='sortable' :column="'important'">
                                {{ __('Important') }}</th>

                            <th></th>
                        </tr>

                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in collection" :key="item.id">
                            <td><button class="btn btn-danger btn-lg">@{{ item.queue_number }}</button></td>
                            <td>@{{item.patient ? item.patient.patient_code : null}}</td>
                            <td>@{{item.patient ? item.patient.user.full_name_phone : null}}</td>
                            <td>@{{ item.important == 1 ? 'ລູກຄ້າທົ່ວໄປ' : (item.important == 2 ? 'VIP':'Booking') }}
                            </td>
                            <td>
                                <div class="row no-gutters">
                                    <button @click.prevent="show(item)" class="btn btn-spotify btn-sm" type="button">
                                        <i class="fa fa-external-link"></i>
                                    </button>
                                    <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i
                                                class="fa fa-trash-o"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="row" v-if="pagination.state.total > 0">
                    <div class="col-sm">
                        <span class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview')
                            }}</span>
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
</queue-listing>
