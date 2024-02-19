<div class="modal-body">

    <table class="table table-responsive-sm table-bordered">
        <thead>
            <tr>
                <th>Lab Detail</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item,index) in patient_history_last.examination_lab">
                <td>@{{item.lab_detail_name}}</td>
                <td>@{{item.value}}</td>
            </tr>
        </tbody>
    </table>

    <button class="btn btn-primary btn-sm pull-right m-b-0" @click.prevent="onExaminationResult" type="button">
        {{ __('Examination Result') }}</button>
    <button class="btn btn-danger btn-sm pull-right m-b-0 mr-2" @click.prevent="hide" type="button">
        {{ __('Close') }}</button>

</div>
