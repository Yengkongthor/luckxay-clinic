<medicine-listing :data="{{ $data->toJson() }}" :url="'{{ url($url) }}'" inline-template v-cloak>
    <div class="card h-100">
        <div class="card-header">
            <form @submit.prevent="">
                <div class="row justify-content-md-between">
                    <div class="col col-lg-7 col-xl-5 form-group">
                        <div class="input-group">
                            <input class="form-control"
                                placeholder="{{ trans('brackets/admin-ui::admin.placeholder.search') }}"
                                v-model="search" @keyup.enter="filter('search', $event.target.value)" />
                            <span class="input-group-append">
                                <button type="button" class="btn btn-primary" @click="filter('search', search)"><i
                                        class="fa fa-search"></i>&nbsp;
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
        </div>
        <div class="card-body p-0" v-cloak>
            <div class="card-block p-0">

                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th is='sortable' :column="'brand_name'">
                                {{ trans('admin.medicine.columns.brand_name') }}</th>
                            <th is='sortable' :column="'cheminal_name'">
                                {{ trans('admin.medicine.columns.cheminal_name') }}</th>
                            <th is='sortable' :column="'type'">
                                {{ __('Type') }}</th>
                            <th>Dose</th>
                            <th>
                                {{ trans('admin.medicine.columns.price') }}</th>
                            <th>
                                {{ __('Amount') }}</th>
                            <th>
                                {{ __('Manufacture Date') }}</th>
                            <th>
                                {{ __('Best Before Date') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in collection" :key="item.id" @click.prevent="onAdd(item)">

                            <td>@{{ item.medicine.brand ? item.medicine.brand.name : ''}}</td>
                            <td>@{{ item.medicine.cheminal_name }}</td>
                            <td>@{{ item.medicine.category ? item.medicine.category.name: '' }}</td>
                            <td>@{{ item.medicine.dose }}</td>
                            <td>@{{ item.medicine.price }}</td>
                            <td>@{{ item.current_amount }}</td>
                            <td>@{{ item.manufacture_date  }}</td>
                            <td>@{{ item.best_before_date  }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="row pl-3" v-if="pagination.state.total > 0">
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
</medicine-listing>
