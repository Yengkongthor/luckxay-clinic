@extends('admin.layout.default')

@section('title', trans('admin.book-an-appointment.actions.index'))

@section('body')

<book-an-appointment-listing :today-date="'{{ now()->format('Y-m-d') }}'" :data="{{ $data->toJson() }}"
    :url="'{{ url('admin/book-an-appointments') }}'" inline-template>
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body" v-cloak>
                    <div class="card-block">
                        <full-calendar ref="fullCalendar" :options="calendarOptions" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <p class="text-left m-0" v-cloak>
                        {{ trans('admin.book-an-appointment.actions.index') }}
                        (@{{ selected.date }})
                    </p>
                </div>
                <div class="card-body p-0" v-cloak>
                    <div class="card-block m-0 p-0">
                        <div class="list-group list-group-flush">
                            <div v-for="item in dateEvents" href="#" class="list-group-item list-group-item-action">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="mb-1">@{{ item.name }}</p>
                                        <p class="text-muted">Tel: @{{ item.tel }}</p>
                                        <small class="text-muted">{{ __('Time:') }} @{{ item.time }}</small>
                                        <br>
                                        <small class="text-muted">Purpose: @{{ item.purpose }}</small> <br>
                                        <small class="text-muted">Status Booking: @{{ item.status }}</small>

                                    </div>
                                    <div class="row no-gutters" v-if="item.status == 'wait'">
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-primary btn-sm mr-1"
                                                @click.prevent="addToQueue(item)">
                                                <i class="fa fa-address-book-o"></i>
                                            </button>
                                        </div>
                                        <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i
                                                    class="fa fa-trash-o"></i></button>
                                        </form>
                                    </div>
                                    <div v-if="dateEvents.length == 0" href="#"
                                        class="list-group-item list-group-item-action ">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="mb-1">{{ __('No appointment.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            @include('admin.book-an-appointment.components.modal-create-appointment')
            @include('admin.book-an-appointment.components.modal-create-patient')
        </div>
    </div>
</book-an-appointment-listing>

@endsection
