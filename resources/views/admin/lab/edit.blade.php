@extends('admin.layout.default')
@section('title', trans('admin.lab.actions.edit', ['name' => $lab->name]))

@section('body')

<div class="container-xl">
    <div class="card">

        <lab-form :action="'{{ $lab->resource_url }}'" :data="{{ $lab->toJson() }}" v-cloak inline-template>

            <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action"
                novalidate>


                <div class="card-header">
                    <i class="fa fa-pencil"></i> {{ trans('admin.lab.actions.edit', ['name' => $lab->name]) }}
                </div>

                <div class="card-body">
                    @include('admin.lab.components.form-elements')
                </div>

                @include('admin.partials.save-button')
                @include('admin.partials.back-button')
            </form>

        </lab-form>

    </div>

    <lab-detail-listing :data="{{ $data->toJson() }}" :lab-id="{{$lab->id}}"
        :url="'{{ url('admin/lab-details?labId='.$lab->id) }}'" :action="'{{ url('admin/lab-details') }}'"
        inline-template>

        <div class="row">
            @include('admin.partials.modal.modal',['name'=>'lab-detail','beforeOpen'=>'beforeOpen','body'=>view('admin.lab.components.modals.modal-lab-detail')])
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.lab-detail.actions.index') }}
                        <button class="btn btn-primary btn-sm pull-right m-b-0" type="button"
                            @click.prevent="show('null')">
                            <i class="fa fa-plus"></i>&nbsp;
                            {{ trans('admin.lab-detail.actions.create') }}
                        </button>
                    </div>
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
                                        <th class="bulk-checkbox">
                                            <input class="form-check-input" id="enabled" type="checkbox"
                                                v-model="isClickedAll" v-validate="''" data-vv-name="enabled"
                                                name="enabled_fake_element"
                                                @click="onBulkItemsClickedAllWithPagination()">
                                            <label class="form-check-label" for="enabled">
                                                #
                                            </label>
                                        </th>

                                        <th is='sortable' :column="'id'">{{ trans('admin.lab-detail.columns.id') }}
                                        </th>
                                        <th is='sortable' :column="'lab_id'">
                                            {{ trans('admin.lab-detail.columns.lab_id') }}
                                        </th>
                                        <th is='sortable' :column="'name'">
                                            {{ trans('admin.lab-detail.columns.name') }}</th>
                                        <th is='sortable' :column="'unit'">
                                            {{ trans('admin.lab-detail.columns.unit') }}</th>
                                        <th is='sortable' :column="'reference'">
                                            {{ trans('admin.lab-detail.columns.reference') }}</th>
                                        <th is='sortable' :column="'cost'">
                                            {{ trans('admin.lab-detail.columns.cost') }}</th>
                                        <th is='sortable' :column="'price'">
                                            {{ trans('admin.lab-detail.columns.price') }}
                                        </th>

                                        <th></th>
                                    </tr>
                                    <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                        <td class="bg-bulk-info d-table-cell text-center" colspan="9">
                                            <span
                                                class="align-middle font-weight-light text-dark">{{ trans('brackets/admin-ui::admin.listing.selected_items') }}
                                                @{{ clickedBulkItemsCount }}. <a href="#" class="text-primary"
                                                    @click="onBulkItemsClickedAll('/admin/lab-details')"
                                                    v-if="(clickedBulkItemsCount < pagination.state.total)"> <i
                                                        class="fa"
                                                        :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i>
                                                    {{ trans('brackets/admin-ui::admin.listing.check_all_items') }}
                                                    @{{ pagination.state.total }}</a> <span
                                                    class="text-primary">|</span> <a href="#" class="text-primary"
                                                    @click="onBulkItemsClickedAllUncheck()">{{ trans('brackets/admin-ui::admin.listing.uncheck_all_items') }}</a>
                                            </span>

                                            <span class="pull-right pr-2">
                                                <button class="btn btn-sm btn-danger pr-3 pl-3"
                                                    @click="bulkDelete('/admin/lab-details/bulk-destroy')">{{ trans('brackets/admin-ui::admin.btn.delete') }}</button>
                                            </span>

                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in collection" :key="item.id"
                                        :class="bulkItems[item.id] ? 'bg-bulk' : ''">
                                        <td class="bulk-checkbox">
                                            <input class="form-check-input" :id="'enabled' + item.id" type="checkbox"
                                                v-model="bulkItems[item.id]" v-validate="''"
                                                :data-vv-name="'enabled' + item.id"
                                                :name="'enabled' + item.id + '_fake_element'"
                                                @click="onBulkItemClicked(item.id)" :disabled="bulkCheckingAllLoader">
                                            <label class="form-check-label" :for="'enabled' + item.id">
                                            </label>
                                        </td>

                                        <td>@{{ item.id }}</td>
                                        <td>@{{ item.lab.name }}</td>
                                        <td>@{{ item.name }}</td>
                                        <td>@{{ item.unit }}</td>
                                        <td>@{{ item.reference }}</td>
                                        <td>@{{ item.cost }}</td>
                                        <td>@{{ item.price }}</td>

                                        <td>
                                            <div class="row no-gutters">
                                                <div class="col-auto">
                                                    <button class="btn btn-sm btn-info"
                                                        title="{{ trans('brackets/admin-ui::admin.btn.edit') }}"
                                                        @click.prevent="show(item)">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
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
                                <button class="btn btn-primary btn-sm pull-right m-b-0" type="button"
                                    @click.prevent="show('null')">
                                    <i class="fa fa-plus"></i>&nbsp;
                                    {{ trans('admin.lab-detail.actions.create') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </lab-detail-listing>



</div>

@endsection