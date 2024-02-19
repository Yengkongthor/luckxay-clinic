<div class="row">
    <div class="col-3">
        @include('admin.user.components.uploads.upload-profile')
        @include('admin.user.components.uploads.upload-document')
    </div>
    <div class="col-9">
        <div class="card">
            <div class="card-header" v-cloak>
                <i class="fa fa-plus"></i> {{ trans('admin.user.actions.create') }} Patient Id:
                @{{ form . patient . patient_code }}
            </div>
            <div class="card-body">
                <div class="row">
                    @include('admin.partials.input.input-col-md-6',[
                    'name'=>'phone',
                    'model'=>'form.phone',
                    'label'=>'ເບິໂທ',
                    'placeholder'=>'+85620xxxxxxxx',
                    'validate'=>'required',
                    ])
                    @include('admin.partials.input.input-col-md-6',[
                    'name'=>'sos',
                    'model'=>'form.patient.sos',
                    'label'=>'ເບິຕິດຕໍ່ສຸກເສີນ',
                    'placeholder'=>'+85620xxxxxxxx',
                    'validate'=>'',
                    ])
                    @include('admin.partials.input.input-col-md-6',[
                    'name'=>'name',
                    'model'=>'form.name',
                    'label'=>'ຊື່ແທ້',
                    'placeholder'=>'First name',
                    'validate'=>'required'
                    ])

                    @include('admin.partials.input.input-col-md-6',[
                    'name'=>'surname',
                    'model'=>'form.surname',
                    'label'=>'ນາມສະກຸນ',
                    'placeholder'=>'Last name',
                    'validate'=>'required'
                    ])
                    @include('admin.partials.input.input-col-md-6',[
                    'name'=>'email',
                    'model'=>'form.email',
                    'label'=>'Email',
                    'placeholder'=>'',
                    'validate'=>''
                    ])

                    {{-- @include('admin.partials.input.input-col-md-6',[
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
                    {{-- @include('admin.partials.input.input-col-md-6',[
                    'name'=>'patient_nick_name',
                    'model'=>'form.patient.nick_name',
                    'label'=>'ຊື່ຫຼີ້ນ',
                    'placeholder'=>'ຊື່ຫຼີ້ນ',
                    'validate'=>''
                    ]) --}}

                    <div class="col-md-6">
                        <div class="form-group "
                            :class="{'has-danger': errors.has('patient_birth_date'), 'has-success': fields.patient_birth_date && fields.patient_birth_date.valid }">
                            <p for="patient_birth_date">ວັນເດືອນປີເກີດ</p>
                            <div class="input-group input-group--custom">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <datetime v-model="form.patient.birth_date" :config="datePickerConfig" class="flatpickr"
                                    :class="{'form-control-danger': errors.has('patient_birth_date'), 'form-control-success': fields.patient_birth_date && fields.patient_birth_date.valid}"
                                    id="patient_birth_date" name="patient_birth_date" v-validate="'required'"
                                    placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_date') }}">
                                </datetime>
                            </div>
                            <div v-if="errors.has('patient_birth_date')" class="form-control-feedback form-text"
                                v-cloak>
                                @{{ errors . first('patient_birth_date') }}</div>
                        </div>
                    </div>
                    @if (isset($user))
                        @include('admin.partials.input.input-col-md-6',[
                        'disabled'=>'true',
                        'name'=>'age',
                        'model'=>'form.patient.age',
                        'label'=>'ອາຍຸ',
                        'placeholder'=>'age',
                        'validate'=>'required'
                        ])
                    @endif

                    @if (isset($user))
                        @include('admin.partials.input.input-col-md-6',[
                        'name'=>'password',
                        'model'=>'form.password',
                        'label'=>'Password',
                        'type'=>'password',
                        'placeholder'=>'password',
                        ])
                    @endif


                    <div class="col-md-12">
                        <div class="form-group row">
                            <p class="col-md-3 col-form-label">Gender</p>
                            <div class="col-md-9 col-form-label">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="form-check-input" id="male" type="radio" v-model="form.patient.gender"
                                        value="male" name="patient_gender">
                                    <label class="form-check-label mb-0" for="male">Male</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="form-check-input" id="female" type="radio"
                                        v-model="form.patient.gender" value="female" name="patient_gender">
                                    <label class="form-check-label mb-0" for="female">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <p for="">ປະຫັວດພະຍາດປະຈຸບັນ</p><br>
                        <div class="form-group">
                            <quill-editor v-model="form.patient.diseases_history" :options="wysiwygConfig" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p for="">ປະຫວັດການໃຊ້ຢາ</p><br>
                        <div class="form-group">
                            <quill-editor v-model="form.patient.medicine_history" :options="wysiwygConfig" />
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row">
                            <p class="col-md-3 col-form-label">ປະຫວັດການແພ້ຢາ ຫຼື ອາຫານ</p>
                            <div class="col-md-9 col-form-label">
                                <div class="form-check form-check-inline mr-1">
                                    <input class="form-check-input" id="inline-radio1" type="radio"
                                        v-model="form.patient.drug_allergy_or_food" value="1" name="inline-radios">
                                    <label class="form-check-label mb-0" for="inline-radio1">ມີ</label>
                                </div>
                                <div class="form-check form-check-inline mr-1">
                                    <input class="form-check-input" id="inline-radio2" type="radio"
                                        v-model="form.patient.drug_allergy_or_food" value="0" name="inline-radios">
                                    <label class="form-check-label mb-0" for="inline-radio2">ບໍມີ</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" v-if="form.patient.drug_allergy_or_food == 1">
                        <label for="">ຊື່ຢາ/ອາຫານທີ່ແພ້</label><br>
                        <div class="form-group">
                            <quill-editor v-model="form.patient.drug_or_food" :options="wysiwygConfig" />
                        </div>
                    </div>



                    @include('admin.partials.input.input-col-md-6',[
                    'name'=>'patient_marital_status',
                    'model'=>'form.patient.marital_status',
                    'label'=>'ສະຖານນະພາບ',
                    'placeholder'=>'ໂສດ,ແຕງງານ,...',
                    'validate'=>''
                    ])

                    @include('admin.partials.input.input-col-md-6',[
                    'name'=>'patient_blood_group',
                    'model'=>'form.patient.blood_group',
                    'label'=>'ເລືອດ',
                    'placeholder'=>'A,B,AB,O',
                    'validate'=>''
                    ])
                    @include('admin.partials.input.input-col-md-6',[
                    'name'=>'job',
                    'model'=>'form.patient.job',
                    'label'=>'ອາຊີບ',
                    'placeholder'=>'',
                    'validate'=>''
                    ])

                    <div class="col-6">
                        <div class="form-group ">
                            <p >ລາຍຮັບສະເລ່ຍ</p>
                            <select name="salary" id="salary" class="form-control" v-model="form.patient.salary">
                                <option value="ຕ່ຳກວ່າ 2 ລ້ານ">ຕ່ຳກວ່າ 2 ລ້ານ</option>
                                <option value="2-5 ລ້ານ">2-5 ລ້ານ</option>
                                <option value="5-8 ລ້ານ">5-8 ລ້ານ</option>
                                <option value="8.5-10 ລ້ານ">8.5-10 ລ້ານ</option>
                                <option value="10 ລ້ານຂື້ນໄປ">10 ລ້ານຂື້ນໄປ</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group ">
                            <p for="province">ແຂວງ</p>
                            <multiselect @input="onChange" v-model="form.patient.province"
                                :options="{{ $provinces->toJson() }}" placeholder="Select provinces" label="la_name"
                                track-by="id" :multiple="false">
                            </multiselect>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group" v-if="form.districts">
                            <p v-if="form.districts">ເມືອງ</p>
                            <div class="row">
                                <div class="col-3" v-for="(item,index) in form.districts">
                                    <div class="form-check form-check-inline mr-1">
                                        <input class="form-check-input" :id="'d'+item.id"
                                            v-model="form.patient.district" type="radio" :value="item.name"
                                            :name="'d'+item.id">
                                        <label class="form-check-label mb-0"
                                            :for="'d'+item.id">@{{ item . name }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @include('admin.partials.input.input-col-md-6',[
                    'name'=>'patient_district',
                    'model'=>'form.patient.district',
                    'label'=>'ເມືອງ',
                    'placeholder'=>'ເມືອງ',
                    'validate'=>''
                    ]) --}}

                    @include('admin.partials.input.input-col-md-6',[
                    'name'=>'patient_village',
                    'model'=>'form.patient.village',
                    'label'=>'ບ້ານ',
                    'placeholder'=>'ບ້ານ',
                    'validate'=>'',
                    'col'=>'col-md-12'
                    ])

                </div>
            </div>
        </div>



    </div>
</div>
