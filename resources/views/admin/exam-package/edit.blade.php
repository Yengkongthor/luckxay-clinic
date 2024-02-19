@extends('admin.layout.default')

@section('title', trans('admin.exam-package.actions.edit', ['name' => $examPackage->id]))

@section('body')
<exam-package-form :action="'{{ $examPackage->resource_url }}'" :data="{{ $examPackage->toJson() }}" v-cloak
    inline-template>
    <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-pencil"></i>
                    {{ trans('admin.exam-package.actions.edit', ['name' => $examPackage->patientHistory ? $examPackage->patientHistory->patient->lao_first_name :'']) }}

                    <button class="btn btn-sm btn-primary float-right" type="button" @click.prevent="callPateint">Call
                        Pateint</button>
                </div>

                <div class="card-body">
                    <div class="card-block p-0">
                        <p>Doctor: @{{form.employee.lao_first_name}}</p>
                        <p>Package: @{{form.package.name}}</p>

                        <table class="table table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>ລາຍການກວດ</th>
                                    <th>ຜົນກວດ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item,index) in form.patientHistory.examination_services_result">
                                    <td>@{{item.lab_detail.name}}</td>
                                    <td>@{{item.value}}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
{{--
            <div class="card">
                <div class="card-header">{{ __('File')}}</div>
                <div class="card-body p-0">
                    <div class="card-block">
                        <table class="table table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>Lab Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($upload as $item)
                                <tr>
                                    <td>{{ $item->lab ? $item->lab->name : ''}}</td>
                                    <td>
                                        <a target="_blank"
                                            href="{{url($item->getMedia('upload_file')->first() ? $item->getMedia('upload_file')->first()->getUrl() : 'https://via.placeholder.com/1000.png?text=No%20File')}}"
                                            class="btn btn-primary btn-sm">
                                            Open
                                        </a>
                                    </td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}

            <div class="card">
                <div class="card-header">{{ __('Comment Result')}}</div>
                <div class="card-body p-0">
                    <div class="card-block">
                        <quill-editor v-model="form.body" :options="wysiwygConfig" />
                    </div>
                </div>
            </div>

            <doctor-medicine-listing :data="{{ $data->toJson() }}" :medicines="{{$medicines}}"
                :patient-history-id="{{$patientHistoryId}}" :url="'{{ url('admin/examination-results/doctor-medicine/'.$patientHistoryId) }}'"
                inline-template>

                <div class="row">
                    @include('admin.partials.modal.modal',['name'=>'doctor-medicine','body'=>view('admin.examination-result.components.modals.doctor-medicine')])
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> {{ trans('admin.doctor-medicine.actions.index') }}
                                <button class="btn btn-primary btn-sm float-right" @click.prevent="show"><i
                                        class="fa fa-plus"></i>&nbsp;Add
                                    Medicine</button>
                            </div>
                            <div class="card-body" v-cloak>
                                <div class="card-block">
                                    <form @submit.prevent="">
                                        <div class="row justify-content-md-between">
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
                                                    {{ trans('admin.doctor-medicine.columns.id') }}</th>
                                                <th is='sortable' :column="'amount'">
                                                    {{ trans('admin.doctor-medicine.columns.amount') }}</th>
                                                <th is='sortable' :column="'cheminal_name'">
                                                    {{ trans('admin.doctor-medicine.columns.cheminal_name') }}</th>


                                                <th></th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, index) in collection" :key="item.id">

                                                <td>@{{ item.id }}</td>

                                                <td>@{{ item.amount }}</td>
                                                <td>@{{ item.cheminal_name }}</td>

                                                <td>
                                                    <div class="row no-gutters">

                                                        <form class="col"
                                                            @submit.prevent="deleteItem(item.resource_url)">
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
                </div>
            </doctor-medicine-listing>
            @include('admin.partials.save-button')
            @include('admin.partials.back-button')
        </div>

    </form>

</exam-package-form>

@endsection
