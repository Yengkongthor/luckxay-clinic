@extends('admin.layout.default')


@section('title', trans('admin.lab-detail.actions.edit', ['name' => $labDetail->name]))

@section('body')


<lab-detail-form :action="'{{ $labDetail->resource_url }}'" :labs="{{ $labs->toJson()  }}"
    :data="{{ $labDetail->toJson() }}" v-cloak inline-template>

    <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>

        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        {{  __('Labs') }}
                    </div>
                    <div class="card-body">
                        <div class="form-group row ">
                            <div class="col-form-label pl-3" v-for="(item,index) in labs">
                                <div class="form-check form-check-inline mr-1">
                                    <input class="form-check-input " :id="'inline-radio' + index" type="radio"
                                        :value="item.id" name="inline-radios" v-model="form.lab_id">
                                    <label class="form-check-label m-0" :for="'inline-radio' + index">
                                        @{{item.name}}
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-plus"></i> {{ trans('admin.lab-detail.actions.create') }}
                    </div>

                    <div class="card-body">
                        @include('admin.lab-detail.components.form-elements')
                    </div>
                    @include('admin.partials.save-button')
                    @include('admin.partials.back-button')
                </div>
            </div>
        </div>

    </form>

</lab-detail-form>

</div>

</div>

@endsection
