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

<p style="text-align: center">ລາຍງານເພີ່ມສາງ ວັນທີ {{$dateForm}} - {{$dateTo}}</p>


<table class="table1">
    <thead>
        <tr>
            <th>​ລ/ດ</th>
            <th>ລາຍການ </th>
            <th>ຜູ້ສະໜອງ</th>
            <th>ຈຳນວນ</th>
            <th>ລາຄາ</th>
        </tr>

    </thead>
    <tbody>
        @foreach ($medicinePricing as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->medicine->cheminal_name }}</td>
            <td>{{ $item->supplier->name }}</td>
            <td>{{ $item->amount }}</td>
            <td>{{ number_format($item->base_price) }}</td>

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
