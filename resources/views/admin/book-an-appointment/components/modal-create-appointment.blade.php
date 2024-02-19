<modal name="create-appointment" v-cloak height="auto" width="50%" :scrollable="true" :adaptive="true" :pivot-y="0.25">
    <div class="modal-header">
        <h5 class="modal-title mb-0">
            {{ __('Create appointment') }}
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
            @click.prevent="hideModalCreateAppointment">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <p class="font-weight-bold">{{ __('Date:') }} @{{ selected.date }}</p>

        <label for="user" class="col-form-label font-weight-bold text-dark">
            {{ __('Patient') }}
            <button type="button" class="btn btn-sm btn-outline-primary ml-1 rounded-circle"
                @click.prevent="showModalCreatePatient">
                <span class="fa fa-plus"></span>
            </button>
        </label>
        <multiselect v-model="selectedUser" placeholder="{{ __('Select patient') }}" :options="users"
            open-direction="bottom" label="full_name_phone"></multiselect>

        <p class="font-weight-bold mt-3">{{ __('Morning') }}</p>
        <div v-for="item in morning_times" class="custom-control custom-radio custom-control-inline">
            <input type="radio" :id="item.id" class="custom-control-input" :disabled="item.off" :value="item.id"
                v-model="form.booking_time">
            <label class="custom-control-label" :class="{'text-dark': !item.off, 'text-warning': item.off}"
                :for="item.id">
                @{{ item.time }}
            </label>
        </div>
        <p class="font-weight-bold mt-3">{{ __('Afternoon') }}</p>
        <div v-for="item in afternoon_times" class="custom-control custom-radio custom-control-inline">
            <input type="radio" :id="item.id" class="custom-control-input" :disabled="item.off" :value="item.id"
                v-model="form.booking_time">
            <label class="custom-control-label" :class="{'text-dark': !item.off, 'text-warning': item.off}"
                :for="item.id">
                @{{ item.time }}
            </label>
        </div>
        <div class="form-group mt-3">
            <input type="text" class="form-control" v-model="form.purpose" placeholder="Purpose">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" @click.prevent="createAppointment"
            :disabled="form.booking_time == null || selectedUser == null">Create</button>
        <button type="button" class="btn btn-secondary" @click.prevent="hideModalCreateAppointment">Cancel</button>
    </div>
</modal>