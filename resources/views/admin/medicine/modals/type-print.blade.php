<div class="modal-header">
    <h5 class="modal-title">Type Print</h5>

</div>
<div class="modal-body">
    <div class="form-group row">
        <label class="col-md-3 col-form-label">Select</label>
        <div class="col-md-9 col-form-label">
            <div class="form-check form-check-inline mr-1">
                <input class="form-check-input" id="inline-radio1" type="radio" value="all" name="inline-radios"
                    v-model="typePrint">
                <label class="form-check-label mb-0" for="inline-radio1">ທັງໝົດ</label>
            </div>
            <div class="form-check form-check-inline mr-1">
                <input class="form-check-input" id="inline-radio2" type="radio" value="warning" name="inline-radios"
                    v-model="typePrint">
                <label class="form-check-label mb-0" for="inline-radio2">ໃກ້ໝົດ</label>
            </div>
            <div class="form-check form-check-inline mr-1">
                <input class="form-check-input" id="inline-radio3" type="radio" value="danger" name="inline-radios"
                    v-model="typePrint">
                <label class="form-check-label mb-0" for="inline-radio3">ໝົດແລ້ວ</label>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary" @click.prevent="onPrintStock">ພິມ</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click.prevent="hide">Close</button>
</div>
