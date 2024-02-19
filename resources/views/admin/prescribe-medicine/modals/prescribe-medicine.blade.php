
<table class="table table-responsive-sm">
    <thead>
        <tr>
            <th>ລໍາດັບ </th>
            <th>ລາຍການ/Description </th>
            <th>ຈຳນວນ</th>
            <th>ເລືອກ</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="(item,index) in prescribe_medicine">
            <td>@{{index + 1}}</td>
            <td>@{{item.cheminal_name}}</td>
            <td>@{{item.amount}}</td>
            <td>
                <div class="btn-group mb-2" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary" @click.prevent="onPrintMedicine(queue_id,'7x5',item.id)">70mm x 50mm</button>
                    <button type="button" class="btn btn-primary" @click.prevent="onPrintMedicine(queue_id,'10x8',item.id)">100mm x 80mm</button>
                    <button type="button" class="btn btn-primary" @click.prevent="onPrintMedicine(queue_id,'10x15',item.id)">100mm x 150mm</button>
                </div>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-warning" @click.prevent="onPrintSaline(queue_id,'7x5')">70mm x 50mm</button>
                    <button type="button" class="btn btn-warning" @click.prevent="onPrintSaline(queue_id,'10x8')">100mm x 80mm</button>
                    <button type="button" class="btn btn-warning" @click.prevent="onPrintSaline(queue_id,'10x15')">100mm x 150mm</button>
                </div>
            </td>
        </tr>
    </tbody>
</table>

{{-- <button type="button" v-if="queues_status != 'finished'" class="btn btn-primary"
    @click.prevent="onGetMedicine(queue_id)">Get Medicine</button>
<button type="button" class="btn btn-danger" @click.prevent="hide">Close</button> --}}
