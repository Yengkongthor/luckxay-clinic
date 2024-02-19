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
@if ($status == 'summary')
<p style="text-align: center">ລາຍງານຮັບທັງໝົດ ວັນທີ {{$dateForm}} - {{$dateTo}}</p>
@endif
@if ($status == 'medicines')
<p style="text-align: center">ລາຍງານຮັບຂາຍຢາ ວັນທີ {{$dateForm}} - {{$dateTo}}</p>
@endif
@if ($status == 'lab')
<p style="text-align: center">ລາຍງານຮັບຄ່າກວດ ວັນທີ {{$dateForm}} - {{$dateTo}}</p>
@endif
@if ($status == 'stock')
<p style="text-align: center">ລາຍງານສາງ ວັນທີ {{$dateForm}} - {{$dateTo}}</p>
@endif
@if ($status == 'add_stock')
<p style="text-align: center">ລາຍງານເພີ່ມສາງ ວັນທີ {{$dateForm}} - {{$dateTo}}</p>
@endif


@if ($status == 'summary')
    @include('admin.page-report.tables.report-summary')
@endif
@if ($status == 'medicines')
    @include('admin.page-report.tables.report-medicine')
@endif
@if ($status == 'lab')
    @include('admin.page-report.tables.report-summary')
@endif
@if ($status == 'stock')
    @include('admin.page-report.tables.report-summary')
@endif
@if ($status == 'add_stock')
    @include('admin.page-report.tables.report-summary')
@endif


@endsection
@section('script')
<script type="text/javascript">
    window.onload = function() { window.print() }
</script>
@endsection
