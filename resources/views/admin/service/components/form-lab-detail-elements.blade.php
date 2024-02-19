<div v-for="(item,index) in labs">
    <label><strong>@{{item.name}}</strong></label>

    <div class="form-group row">

        <div class="col-md-9 col-form-label">
            <div class="form-check form-check-inline mr-1" v-for="(items,index) in item.labDetails">
                <input class="form-check-input" :id="'inline-checkbox'+items.lab_detail_id" type="checkbox"
                    v-bind:value="{ lab_detail_id: items.lab_detail_id,lab_id: items.lab_id }"
                    v-model="form.lab_detail">
                <label class="form-check-label" :for="'inline-checkbox'+items.lab_detail_id">
                    @{{items.name}}
                </label>
            </div>
        </div>
    </div>
</div>
