<examination-service-view-listing :data="{{ $data->toJson() }}"
    :url="'{{ url('admin/examination-services/load/examination-service?patientHistoryId='.$patientHistoryId) }}'"
    inline-template>
    <form action="{{url('admin/examination-services/update/examination-service')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.examination-service.actions.index') }}
                    </div>
                    <div class="card-body" v-cloak>
                        <div class="row pl-3" v-for='(item,index) in groupData'>
                            <h3>@{{item.groupName}}</h3>
                            <div class="col-sm-12" v-for="(item, index) in item.data">
                                <div class="form-group  row">
                                    <p class="col-md-3 col-form-label" for="name">
                                        @{{item.lab_detail ? item.lab_detail.name : ''}}</p>
                                    <div class="col-md-9">
                                        <input class="form-control" id="name" :name="'value['+item.lab_detail_id+']'"
                                            type="text" :value="item.value">
                                    </div>
                                </div>
                                <input type="hidden" name="patient_history_id" :value="item.patient_history_id">
                                <input type="hidden" name="employee_id" value="{{ auth()->user()->employee->id}}">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary fixed-cta-button button-save ">
                            <i class="fa fa-save"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                    <input type="file" name="upload_file[]" id="upload_file" multiple>

                    </div>
                </div>
            </div>
        </div>
    </form>

</examination-service-view-listing>
