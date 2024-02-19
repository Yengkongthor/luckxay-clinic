<patient-history-listing :data="{{ $dataPatientHistory->toJson() }}"
    :url="'{{ url('admin/examinations/patient-history') }}'" inline-template v-cloak>
    <div class="col-12">
        @include('admin.partials.modal.modal',[
        'name'=>'patient-history-view',
        'width'=>'80%',
        'beforeOpen'=>'beforeOpen',
        'body'=>view('admin.examination.modal.modal-patient-view')
        ])
        <div>
            <div class="card-header">
                <i class="fa fa-align-justify"></i> {{ $examination->patient->user->full_name_phone }}
            </div>
            <div class="card-body p-0" v-cloak>
                <div class="card-block p-0">

                    <table class="table table-hover table-listing">
                        <thead>
                            <tr>
                                <th>#</th>


                                <th is='sortable' :column="'test_at'">
                                    {{ trans('admin.patient-history.columns.test_at') }}</th>

                                <th></th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in collection" :key="item.id">
                                <td>@{{index + 1}}</td>
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

                    <div class="row  p-3" v-if="pagination.state.total > 0">
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
</patient-history-listing>
