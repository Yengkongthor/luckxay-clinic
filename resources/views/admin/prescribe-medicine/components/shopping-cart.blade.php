<shopping-cart-listing :queue-id="{{$queueId}}" :status="'{{ $status }}'" :data="{{ $data->toJson() }}"
    :url="'{{ url($url) }}'" inline-template v-cloak>

    <div class="card h-100">

        @include('admin.partials.modal.modal',['name'=>'amount-shopping','body'=>view('admin.prescribe-medicine.modals.amount-shopping'),'beforeOpen'=>'beforeOpen'])

        <div class="card-header">{{__('Shopping Card')}}</div>
        <div class="card-body p-0">
            <div class="card-block p-0">


                <table class="table table-hover table-listing">
                    <thead>
                        <tr>


                            <th is='sortable' :column="'medicine_id'">
                                {{ trans('admin.shopping-cart.columns.medicine_id') }}</th>

                            <th is='sortable' :column="'price'">{{ trans('admin.shopping-cart.columns.price') }}
                            </th>
                            <th is='sortable' :column="'amount'">
                                {{ trans('admin.shopping-cart.columns.amount') }}</th>

                            <th></th>
                        </tr>

                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in collection" :key="item.id">
                            <td>@{{ item.medicine ? item.medicine.cheminal_name : ''}}</td>
                            <td>@{{ item.price }}</td>
                            <td>@{{ item.amount }}</td>

                            <td>
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <button type="button" @click.prevent="show(item)"
                                            class="btn btn-sm  btn-warning"
                                            title="{{ trans('brackets/admin-ui::admin.btn.edit') }}">Amount
                                        </button>
                                        <button class="btn btn-sm  btn-danger" type="button"
                                            @click.prevent="onRemove(item)"
                                            title="{{ trans('brackets/admin-ui::admin.btn.edit') }}"><i
                                                class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
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
        @if ($noMedicine != 0)

        <button class="btn btn-success" @click.prevent="onConfirm(1)" v-if="collection.length > 0">
            <i class="fa fa-check" aria-hidden="true"></i> {{__('Confirm')}}
        </button>

        @endif

        @if ($noMedicine == 0)
        <button class="btn btn-success" @click.prevent="onConfirm(0)">
            <i class="fa fa-check" aria-hidden="true"></i> {{__('Confirm')}}
        </button>
        @endif
    </div>
</shopping-cart-listing>
