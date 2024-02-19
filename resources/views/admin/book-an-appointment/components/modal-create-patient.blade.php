<modal name="create-patient" v-cloak height="auto" width="50%" :scrollable="true" :adaptive="true" :pivot-y="0.25">
    <user-form-appointment :action="'{{ url('admin/users') }}'" :activation="!!'{{ false }}'" inline-template v-cloak>
        <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action">
            <div class="modal-header">
                <h5 class="modal-title mb-0">
                    {{ __('Create patient') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    @click.prevent="hideModalCreatePatient">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @include('admin.partials.input.input-col-md-6',[
                    'name'=>'phone',
                    'model'=>'form.phone',
                    'label'=>'ເບິໂທ',
                    'placeholder'=>'+85620xxxxxxxx',
                    'validate'=>'required',
                    ])
                    <div class="col"></div>
                    @include('admin.partials.input.input-col-md-6',[
                    'name'=>'name',
                    'model'=>'form.name',
                    'label'=>'ຊື່ແທ້',
                    'placeholder'=>'ຊື່ແທ້',
                    'validate'=>'required'
                    ])

                    @include('admin.partials.input.input-col-md-6',[
                    'name'=>'surname',
                    'model'=>'form.surname',
                    'label'=>'ນາມສະກຸນ',
                    'placeholder'=>'ນາມສະກຸນ',
                    'validate'=>'required'
                    ])
{{--
                    @include('admin.partials.input.input-col-md-6',[
                    'name'=>'patient_lao_first_name',
                    'model'=>'form.patient.lao_first_name',
                    'label'=>'ຊື່ແທ້',
                    'placeholder'=>'ຊື່ແທ້',
                    'validate'=>'required'
                    ])

                    @include('admin.partials.input.input-col-md-6',[
                    'name'=>'patient_lao_last_name',
                    'model'=>'form.patient.lao_last_name',
                    'label'=>'ນາມສະກຸນ',
                    'placeholder'=>'ນາມສະກຸນ',
                    'validate'=>'required'
                    ]) --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" :disabled="submiting">Create</button>
                <button type="button" class="btn btn-secondary" @click.prevent="hideModalCreatePatient">Cancel</button>
            </div>
        </form>
    </user-form-appointment>
</modal>
