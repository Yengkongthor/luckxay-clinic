<table class="table1">
    <thead>
        <tr>
            <th>​ລ/ດ</th>
            <th>ເລກທີບີນ </th>
            <th>ຊື່ ແລະ ນາມສະກຸນລູກຄ້າ</th>
            <th>ຈຳນວນເງີນທີ່ໄດ້ຮັບຕົວຈີງ </th>
        </tr>

    </thead>
    <tbody>
        @foreach ($prescribeMedicines as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>L{{ str_pad($item->id, 8, '0', STR_PAD_LEFT)}}</td>
            <td>{{$item->patientHistory->patient->lao_first_name}}</td>
            <td>{{number_format($item->total_lab_detail - ((($item->prescribeMedicineCharge ? $item->prescribeMedicineCharge->exam_fee_discount: 0)/100)*$item->total_lab_detail))}}
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
