<div class="modal-header">
    <h5 class="modal-title">ຈຳນວນ</h5>
</div>
<div class="modal-body">
    <div class="form-group">
        <input class="form-control" type="text" v-model="amount">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary" @click.prevent="addAmount">Add amount</button>
    <button type="button" class="btn btn-secondary" @click.prevent="hide">Close</button>
</div>
