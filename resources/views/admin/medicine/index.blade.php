@extends('admin.layout.default')


@section('title', trans('admin.medicine.actions.index'))

@section('body')

<medicine-listing :data="{{ $data->toJson() }}" :url="'{{ url('admin/medicines') }}'" inline-template>

    <div class="row">
        @include('admin.partials.modal.modal',['name'=>'medicine-print','body'=>view('admin.medicine.modals.type-print')])
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> {{ trans('admin.medicine.actions.index') }}
                    <a class="btn btn-primary   btn-sm pull-right m-b-0" href="{{ url('admin/medicines/create') }}"
                        role="button"><i class="fa fa-plus"></i>&nbsp;
                        {{ trans('admin.medicine.actions.create') }}</a>
                    <a class="btn btn-primary  btn-sm pull-right m-b-0 mr-1" href="{{ url('/admin/medicines/preview')}}"
                        role="button"><i class="fa fa-file-powerpoint-o"></i>&nbsp; {{ __('Update Price') }}</a>
                    <button class="btn btn-primary  btn-sm pull-right m-b-0 mr-1" @click.prevent="show"><i
                            class="fa fa-print"></i>&nbsp;
                        {{ __('Print Stock') }}</button>
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
                                            name="enabled_fake_element" @click="onBulkItemsClickedAllWithPagination()">
                                        <label class="form-check-label" for="enabled">
                                            #
                                        </label>
                                    </th>

                                    {{-- <th is='sortable' :column="'id'">{{ trans('admin.medicine.columns.id') }}</th> --}}

                                    <th is='sortable'  :column="'cheminal_name'">
                                        {{ trans('admin.medicine.columns.cheminal_name') }}</th>
                                    <th is='sortable' :column="'Branch'"> {{ __('Branch') }}</th>
                                    <th is='sortable' :column="'Category'"> {{ __('Category') }}</th>
                                    <th is='sortable' :column="'dose'">{{ trans('admin.medicine.columns.dose') }}</th>

                                    <th is='sortable' :column="'Amount'"> {{ __('Amount') }}</th>
                                    <th is='sortable' :column="'Min Amount'"> {{ __('Min Amount') }}</th>

                                    <th is='sortable' :column="'price'">{{ trans('admin.medicine.columns.price') }}</th>

                                    <th></th>
                                </tr>
                                <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                    <td class="bg-bulk-info d-table-cell text-center" colspan="11">
                                        <span
                                            class="align-middle font-weight-light text-dark">{{ trans('brackets/admin-ui::admin.listing.selected_items') }}
                                            @{{ clickedBulkItemsCount }}. <a href="#" class="text-primary"
                                                @click="onBulkItemsClickedAll('/admin/medicines')"
                                                v-if="(clickedBulkItemsCount < pagination.state.total)"> <i class="fa"
                                                    :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i>
                                                {{ trans('brackets/admin-ui::admin.listing.check_all_items') }}
                                                @{{ pagination.state.total }}</a> <span class="text-primary">|</span> <a
                                                href="#" class="text-primary"
                                                @click="onBulkItemsClickedAllUncheck()">{{ trans('brackets/admin-ui::admin.listing.uncheck_all_items') }}</a>
                                        </span>

                                        <span class="pull-right pr-2">
                                            <button class="btn btn-sm btn-danger pr-3 pl-3"
                                                @click="bulkDelete('/admin/medicines/bulk-destroy')">{{ trans('brackets/admin-ui::admin.btn.delete') }}</button>
                                        </span>

                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in collection" :key="item.id"
                                :class="[bulkItems[item.id] ? 'bg-bulk' : '',item.amount == 0 ? 'bg-danger' :'',item.amount <= item.min_amount ? 'bg-warning' :'']">
                                    <td class="bulk-checkbox">
                                        <input class="form-check-input" :id="'enabled' + item.id" type="checkbox"
                                            v-model="bulkItems[item.id]" v-validate="''"
                                            :data-vv-name="'enabled' + item.id"
                                            :name="'enabled' + item.id + '_fake_element'"
                                            @click="onBulkItemClicked(item.id)" :disabled="bulkCheckingAllLoader">
                                        <label class="form-check-label" :for="'enabled' + item.id">
                                        </label>
                                    </td>

                                    {{-- <td>@{{ item.id }}</td> --}}
                                    <td>@{{ item.cheminal_name }}</td>

                                    <td>@{{ item.brand ? item.brand.name: '' }}</td>
                                    <td>@{{ item.category ? item.category.name :'' }}</td>
                                    <td>@{{ item.dose }}</td>
                                    <td>@{{ item.amount }}</td>
                                    <td>@{{ item.min_amount }}</td>
                                    <td>@{{ item.price }}</td>

                                    <td>
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <a class="btn btn-sm   btn-info" :href="item.resource_url + '/edit'"
                                                    title="{{ trans('brackets/admin-ui::admin.btn.edit') }}"
                                                    role="button"><i class="fa fa-edit"></i></a>
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
                            <a class="btn btn-primary  " href="{{ url('admin/medicines/create') }}" role="button"><i
                                    class="fa fa-plus"></i>&nbsp;
                                {{ trans('admin.medicine.actions.create') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <iframe :src="printStock" v-if="printStock" class="d-none"></iframe>
    </div>
</medicine-listing>

@endsection
