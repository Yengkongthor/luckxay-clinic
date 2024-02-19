<div class="card-body">

    <div class="form-group">
        <multiselect v-model="value" :options="medicines" label="name_amount" track-by="id" placeholder="Pick a name">
        </multiselect>
    </div>
    <div class="form-group">
        <p for="name">Amount</p>
        <input class="form-control" id="Amount" type="text" placeholder="Enter Amount" v-model="amount">
    </div>

    <div class="form-group row">
        <p class="col-md-3 col-form-label">Dose</p>
        <div class="col-md-9 col-form-label">
            <input class="form-control" id="text-input" type="text" name="text-input" placeholder="Dose: 500mg, 250mg, 150mg..." v-model="dose">
        </div>
    </div>
    <div class="form-group row">
        <p class="col-md-3 col-form-label">ກິນ</p>
        <div class="col-md-9 col-form-label">
            <input class="form-control" id="text-input" type="text" name="text-input" placeholder="ex: 1 ບ່ວງ,2 ບ່ວງ..." v-model="use">
        </div>
    </div>
    <div class="form-group row">
        <p class="col-md-3 col-form-label">Time</p>
        <div class="col-md-9 col-form-label">
            <div class="form-check form-check-inline mr-1">
                <input class="form-check-input" id="morning" type="checkbox" value="morning" v-model="times">
                <label class="form-check-label" for="morning">ເຊົ້າ (Morning)</label>
            </div>
            <div class="form-check form-check-inline mr-1">
                <input class="form-check-input" id="afternoon" type="checkbox" value="afternoon" v-model="times">
                <label class="form-check-label" for="afternoon">ສວາຍ (Afternoon)</label>
            </div>
            <div class="form-check form-check-inline mr-1">
                <input class="form-check-input" id="evening" type="checkbox" value="evening" v-model="times">
                <label class="form-check-label" for="evening">ແລງ (Evening)</label>
            </div>
            <div class="form-check form-check-inline mr-1">
                <input class="form-check-input" id="before_bedtime" type="checkbox" value="before_bedtime"
                    v-model="times">
                <label class="form-check-label" for="before_bedtime">ກ່ອນນອນ (Before Bedtime)</label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <p class="col-md-3 col-form-label">Tablets</p>
        <div class="col-md-9 col-form-label">
            <div class="form-check form-check-inline mr-1">
                <input class="form-check-input" id="before_meals" type="checkbox" value="before_meals" v-model="tablets">
                <label class="form-check-label" for="before_meals">ກ່ອນອາຫານ (Before meals)</label>
            </div>
            <div class="form-check form-check-inline mr-1">
                <input class="form-check-input" id="after_meals" type="checkbox" value="after_meals" v-model="tablets">
                <label class="form-check-label" for="after_meals">ຫຼັງອາຫານ (After meals)</label>
            </div>
            <div class="form-check form-check-inline mr-1">
                <input class="form-check-input" id="3_minutes" type="checkbox" value="3_minutes" v-model="tablets">
                <label class="form-check-label" for="3_minutes">3 ນາທີ</label>
            </div>
            <div class="form-check form-check-inline mr-1">
                <input class="form-check-input" id="30_minutes" type="checkbox" value="30_minutes" v-model="tablets">
                <label class="form-check-label" for="30_minutes">30 ນາທີ</label>
            </div>
        </div>
    </div>

    <button class="btn btn-sm btn-primary" type="button" @click.prevent="onSave">
        <i class="fa fa-dot-circle-o"></i> Save</button>
    <button class="btn btn-sm btn-danger" type="button" @click.prevent="hide">
        <i class="fa fa-ban"></i> Close</button>
</div>
