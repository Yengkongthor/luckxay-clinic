<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label>@{{title ?? ''}}</label>

        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label for="name">Date Form </label>
            <div class="input-group input-group--custom">
                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                <datetime v-model="date_form" :config="datePickerConfig" v-validate="'date_format:yyyy-MM-dd'"
                    class="flatpickr"
                    :class="{'form-control-danger': errors.has('date_form'), 'form-control-success': this.fields.date_form && this.fields.date_form.valid}"
                    id="date_form" name="date_form"
                    placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_date') }}"></datetime>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label for="name">Date To </label>
            <div class="input-group input-group--custom">
                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                <datetime v-model="date_to" :config="datePickerConfig" v-validate="'date_format:yyyy-MM-dd'"
                    class="flatpickr"
                    :class="{'form-control-danger': errors.has('date_to'), 'form-control-success': this.fields.date_to && this.fields.date_to.valid}"
                    id="date_to" name="date_to"
                    placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_date') }}"></datetime>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">

            <button class="btn btn-sm btn-primary" type="button" v-if="status == 'add_stock' && date_form"
                @click.prevent="onPirntReportAddStock">
                Pirnt Stock</button>
            <button class="btn btn-sm btn-primary" type="button"  v-if="date_form && date_to && status != 'add_stock'" @click.prevent="onPirntReport(status)">
                Pirnt</button>
        </div>
    </div>

</div>
