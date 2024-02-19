<div class="card-body">
    <div class="form-group">
        <label class="col-form-label" for="hf-email">Value</label>
        <input class="form-control" type="text" placeholder="Value" v-model="value">
    </div>
    <button class="btn btn-sm btn-primary" type="button" @click.prevent="onSave">
        <i class="fa fa-save"></i> Save</button>
    <button class="btn btn-sm btn-danger" type="button" @click.prevent="hide">
        <i class="fa fa-close"></i> Close</button>
</div>
