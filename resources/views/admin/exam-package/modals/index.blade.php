<div class="modal-header">
    <h5 class="modal-title">Assgin to doctor</h5>
</div>
<div class="modal-body">


    <multiselect v-model="doctor" :options="doctors" :multiple="false" track-by="id" label="lao_full_name"
        tag-placeholder="{{ __('Select Doctor') }}" placeholder="{{ __('Doctor') }}">
    </multiselect>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary"
        @click.prevent="onAssignDoctor">Assign</button>
    <button type="button" class="btn btn-secondary" @click.prevent="hide">Close</button>
</div>
