<div class="card">
    <div class="card-header">
        <i class="fa fa-align-justify"></i>
        {{ trans('admin.booking-time.actions.index',['name' => $name]) }}
    </div>
    <div class="card-body p-0" v-cloak>
        <div class="card-block  p-0">


            <table class="table table-hover table-listing">
                <thead>
                    <tr>
                        {{-- <th is='sortable' :column="'id'">{{ trans('admin.booking-time.columns.id') }}
                        </th> --}}
                        <th is='sortable' :column="'start_time'">
                            {{ trans('admin.booking-time.columns.start_time') }}</th>
                        <th is='sortable' :column="'end_time'">
                            {{ trans('admin.booking-time.columns.end_time') }}</th>
                        <th is='sortable' :column="'status'">
                            {{ __('Status') }}</th>


                        <th></th>
                    </tr>

                </thead>
                <tbody>
                    <tr v-for="(item, index) in collection" :key="item.id">


                        {{-- <td>@{{ item.id }}</td> --}}
                        <td>@{{ item.start_time | time('HH:mm') }}</td>
                        <td>@{{ item.end_time | time('HH:mm') }}</td>
                        <td>
                            <label class="switch switch-3d switch-success">
                                <input type="checkbox" class="switch-input" v-model="collection[index].status"
                                    @change="toggleSwitch(item.resource_url, 'status', collection[index])">
                                <span class="switch-slider"></span>
                            </label>
                        </td>

                        <td>
                            <div class="row no-gutters">
                                <div class="col-auto">
                                    <button class="btn btn-sm btn-info" type="button"
                                        @click.prevent="onEdit(collection[index])"
                                        title="{{ trans('brackets/admin-ui::admin.btn.edit') }}"><i
                                            class="fa fa-edit"></i>
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

            <div class="row px-2" v-if="pagination.state.total > 0">
                <div class="col-sm">
                    <span class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>
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