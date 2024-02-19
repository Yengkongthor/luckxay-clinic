<div class="card">
    <div class="card-header">
        <i class="fa fa-align-justify"></i> {{ trans('admin.permission.actions.index') }}
    </div>

    <div class="card-body" v-cloak>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="bulk-checkbox" colspan="4">
                        <input class="form-check-input" id="enabled" type="checkbox" v-model="isClickedAll"
                            v-validate="''" data-vv-name="enabled" name="enabled_fake_element"
                            @click="onBulkItemsClickedAll()">
                        <label class="form-check-label" for="enabled">
                            <template v-if="isClickedAll">
                                {{ trans('brackets/admin-ui::admin.listing.uncheck_all_items') }}
                            </template>
                            <template v-else>
                                {{ trans('brackets/admin-ui::admin.listing.check_all_items') }}
                            </template>
                        </label>
                    </th>
                    {{-- <th>{{ trans('admin.permission.columns.id') }}</th> --}}
                    {{-- <th>{{ trans('admin.permission.columns.name') }}</th> --}}
                    {{-- <th>{{ trans('admin.permission.columns.guard_name') }}</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($permissionKeys as $key => $value)
                @include('admin.role.components.group', ['name' => $key, 'values' => $value])
                @endforeach
            </tbody>
        </table>
    </div>
</div>
