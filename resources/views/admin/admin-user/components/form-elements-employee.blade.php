<div class="row">
    @include('admin.partials.input.input-col-md-6',[
    'name'=>'lao_first_name',
    'model'=>'form.employee.lao_first_name',
    'label'=>'Lao First name',
    'placeholder'=>'Lao First name',
    'validate'=>'required',
    ])

    @include('admin.partials.input.input-col-md-6',[
    'name'=>'lao_last_name',
    'model'=>'form.employee.lao_last_name',
    'label'=>'Lao Last name',
    'placeholder'=>'Lao Last name',
    'validate'=>'required',
    ])

    @include('admin.partials.input.input-col-md-6',[
    'name'=>'phone',
    'model'=>'form.employee.phone',
    'label'=>'ເບິໂທ',
    'placeholder'=>'+85620xxxxxxxx',
    'validate'=>'required',
    ])

    <div class="col-6">
        <div class="form-group "
            :class="{'has-danger': errors.has('position'), 'has-success': fields.position && fields.position.valid }">
            <label for="position">Position</label>
            <select class="custom-select form-control" id="position" name="position" v-validate="'required'"
                v-model="form.employee.position">
                <option v-for="(value, name, index) in {{ json_encode(trans('admin.positions')) }}" :value="name">
                    @{{ value }}
                </option>
            </select>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group "
            :class="{'has-danger': errors.has('department_code'), 'has-success': fields.department_code && fields.department_code.valid }">
            <label for="department_code">{{ __('Departments')}}</label>
            <select class="custom-select form-control" id="department_code" name="department_code"
                v-validate="'required'" v-model="form.employee.department_code">
                <option v-for="(item, name, index) in {{ json_encode($departments) }}" :value="item.department_code">
                    @{{ item.name }}
                </option>
            </select>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group "
            :class="{'has-danger': errors.has('branch_id'), 'has-success': fields.branch_id && fields.branch_id.valid }">
            <label for="department_code">{{ __('Branch')}}</label>
            <select class="custom-select form-control" id="branch_id" name="branch_id" v-validate="'required'"
                v-model="form.employee.branch_id">
                <option v-for="(item, name, index) in {{ json_encode($branches) }}" :value="item.id">
                    @{{ item.name }}
                </option>
            </select>
        </div>
    </div>

    <div class="col-12">
        <div class="form-group">
            <div class="form-group row">
                <label class="col-md-2 col-form-label">{{ __('Labs')}}</label>
                <div class="col-md-10 col-form-label">
                    <div class="form-check form-check-inline mr-1" v-for="(item,index) in {{$labs}}">
                        <input class="form-check-input" :id="item.id" type="checkbox" :value="item.id" v-model="form.employee.lab_id">
                        <label class="form-check-label" :for="item.id">@{{item.name}}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
