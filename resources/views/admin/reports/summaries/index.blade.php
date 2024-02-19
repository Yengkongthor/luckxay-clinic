@extends('admin.reports.defult')
@section('css')
<style>
    .table1 {
        width: 100%;
        margin: auto;
        font-size: 14px;
        border: 1px solid #000;
        border-collapse: collapse;
    }

    .table1 th {
        color: #000;
        vertical-align: middle;
        text-align: center;
        border: 1px solid #000;
    }

    .table1 td {
        vertical-align: middle;
        text-align: center;
        border: 1px solid #000;
    }

    .table2 {
        width: 100%;
        margin: auto;
        font-size: 14px;
        /* border: 1px solid #000; */
        border-collapse: collapse;
    }
</style>
@endsection
@section('body')

<table class="table2">
    <tr>
        <td rowspan="3" style="text-align: center"><img src="{{asset('images/logo/logo.jpg')}}" alt="" srcset=""
                width="100"></th>
        <td>ຫຼັກໄຊ ຄີລນິກ </th>
    </tr>
    <tr>
        <td>ຖະ​ໜົນ​ໄກ​ສອນ ພົມວິ​ຫານ,ບ້ານ​ຊ້າງ​ຄູ້,ເມືອງ​ໄຊ​ທາ​ນີ ນະຄອນຫຼວາງວຽງຈັນ
        </td>
    </tr>
    <tr>
        <td>Tel: +85620 5549 8009 ; +85620 9896 2345
        </td>
    </tr>
</table>

<p style="text-align: center">ບັນຊີຕິດຕາມສະຕັອກຢາ ເຂົ້າ-ອອກ ປະຈຳເດືອນ....................................</p>

<table class="table1">
    <thead>
        <tr>
            <th>​ລ/ດ</th>
            <th>ເລກທີບີນ </th>
            <th>ຊື່ ແລະ ນາມສະກຸນລູກຄ້າ</th>
            <th>ຈຳນວນເງີນທີ່ໄດ້ຮັບຕົວຈີງ </th>
            <th>ອາກອນມູນຄ່າເພີ່ມ</th>
            {{-- <th>ສ່ວນຫຼຸດເປີເຊັນ</th> --}}
            <th>ຈຳນວນເງີນຫຼັງລຸດເປີເຊັນ </th>
            <th>ລວມຄ່າວິເຄາະ-ລັງສີ </th>
            <th>ຄ່າບໍລິການ</th>
            <th>ຄ່າຢາ</th>
            <th>ລາຍຊື່ທ່ານໝໍຜູ້ກວດ </th>
        </tr>

    </thead>
    <tbody>
        @foreach ($prescribeMedicine as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>L{{ $item->id }}</td>
            <td>{{$item->patientHistory->patient->lao_first_name}}</td>
            <td>{{$item->money}}</td>
            <td>{{$item->prescribeMedicineCharge->vat}}</td>
            <td>{{$item->total_lab_detail + ($item->prescribeMedicineCharge->charge - ($item->prescribeMedicineCharge->charge*$item->prescribeMedicineCharge->discounted_services/100)) + $item->total_medicine}}
            </td>
            <td>{{$item->total_lab_detail}}</td>
            <td>{{$item->prescribeMedicineCharge->charge}}</td>
            <td>{{$item->total_medicine}}</td>
            <td>{{$item->employee_queue}}</td>
        </tr>
        @endforeach

    </tbody>
</table>
@endsection
@section('script')
<script type="text/javascript">
    window.onload = function() { window.print() }
</script>
@endsection
