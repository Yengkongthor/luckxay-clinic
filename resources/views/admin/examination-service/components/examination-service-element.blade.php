<examination-service-listing :data="{{ $data->toJson() }}" :url="'{{ url($url) }}'" inline-template>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i>
                    {{ trans('admin.examination-service.actions.index') }}
                </div>
                <div class="card-body" v-cloak>
                    <div class="card-block">
                        <table class="table table-hover table-listing">
                            <thead>
                                <tr>
                                    <th is='sortable' :column="'patient_history_id'">
                                        {{ __('Patient') }}</th>
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in collection.patientExamnation" :key="item.id">

                                    <td>@{{ item.patient.user? item.patient.user.name : ''  }}</td>

                                    <td>
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <a class="btn btn-sm   btn-info"
                                                    :href='"/admin/examination-services/view/"+item.id +"?input={{$input?? ''}}"'
                                                    title="{{ trans('brackets/admin-ui::admin.btn.edit') }}"
                                                    role="button"><i class="fa fa-edit"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="no-items-found" v-if="!collection.patientExamnation.length > 0">
                            <i class="icon-magnifier"></i>
                            <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
                            <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</examination-service-listing>
