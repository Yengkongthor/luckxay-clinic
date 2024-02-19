<div class="modal-header">
    <h5 class="modal-title"></h5>
    {{-- <button class="btn btn-success btn-sm float-right" @click.prevent="onPrintMedicinePackage(exam_package_id)">Print ໃບຢາ</button> --}}

</div>
<div class="modal-body p-0">
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
            <tr v-for="(item,index) in doctor_medicines">
                <td>@{{index + 1}}</td>
                <td>@{{item.cheminal_name}}</td>
                <td>@{{item.amount}}</td>
                <td>
                    <div class="btn-group mb-2" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-primary" @click.prevent="onPrintMedicinePackage(exam_package_id,'7x5',item.id)">70mm x 50mm</button>
                        <button type="button" class="btn btn-primary" @click.prevent="onPrintMedicinePackage(exam_package_id,'10x8',item.id)">100mm x 80mm</button>
                        <button type="button" class="btn btn-primary" @click.prevent="onPrintMedicinePackage(exam_package_id,'10x15',item.id)">100mm x 150mm</button>
                    </div>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-warning" @click.prevent="onPrintMedicinePackage(exam_package_id,'7x5')">70mm x 50mm</button>
                        <button type="button" class="btn btn-warning" @click.prevent="onPrintMedicinePackage(exam_package_id,'10x8')">100mm x 80mm</button>
                        <button type="button" class="btn btn-warning" @click.prevent="onPrintMedicinePackage(exam_package_id,'10x15')">100mm x 150mm</button>
                    </div>
                </td>
            </tr>

        </tbody>
    </table>

    <button type="button" v-if="status_exam_package != 'finished'" class="btn btn-primary"
        @click.prevent="onGetMedicinePackage(exam_package_id)">Get Medicine</button>
    <button type="button" class="btn btn-danger" @click.prevent="hidePackage">Close</button>
</div>
