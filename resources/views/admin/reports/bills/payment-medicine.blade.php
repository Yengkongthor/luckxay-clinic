@extends('admin.reports.defult')
@section('css')
<style>
    .table1 tr,
    td {
        /* border: 1px solid black; */
        padding: 0px;

    }

    .table1 {
        border-collapse: collapse;
        width: 100%;
        font-size: 10px;

    }

    .table2 td,
    th {
        border: 1px solid #333333;
        padding: 5px;
    }

    .table2 {
        border-collapse: collapse;
        width: 100%;
        padding: 0;
        font-size: 10px;

    }

    .table2 th {
        height: 50px;
    }

    .table2 tr td {
        padding: 0;
    }

    p {
        padding: 0;
        margin: 0;
    }

    pre {
        display: block;
        white-space: pre;
        margin: 0px;
        padding: 2px;
    }
</style>
@endsection
@section('body')



<table class="table1">
    <tr style="height:80px">
        <td><img src="{{asset('images/logo/logo_no_color.png')}}" alt="" srcset="" width="80px"></td>
        <td style="text-align: center">
            <p style="font-size: 16pt;font-weight: bold;padding-left: 170px">ໃບບິນຮັບເງິນ <br>
                Receipt</p>
        </td>
        <td style="text-align: center">
            <p style="font-size: 11pt">ວັນທີ Date: {{ now()->format('Y-m-d')}}</p>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="padding-left: 10px;font-size: 10pt;">ຫຼັກໄຊຄລີນິກ</td>
        <td style="font-size: 10pt;font-weight: bold;">Luckxay Clinic
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            L{{ str_pad($prescribeMedicine->id, 8, '0', STR_PAD_LEFT)}}</td>
        </td>

    </tr>
    <tr>
        <td colspan="2" style="padding-left: 10px;font-size: 10pt;">ຖະ​ໜົນ​ໄກ​ສອນ
            ພົມວິ​ຫານ,ບ້ານ​ຊ້າງ​ຄູ້,ເມືອງ​ໄຊ​ທາ​ນີ </td>
        <td style="font-size: 10pt;"> Avenue Keysone Phomvihane,Xangkhu Village. </td>
    </tr>
    <tr>
        <td colspan="2" style="padding-left: 10px;font-size: 10pt;">ນະຄອນຫຼວງວຽງຈັນ </td>
        <td style="font-size: 10pt;"> Xaythany Distict Vientiane,Laos </td>
    </tr>
    <tr>
        <td colspan="2" style="padding-left: 10px;font-size: 10pt;:">ໂທ: +85620 5549 8009 ; +85620 9896 2345</td>
        <td style="font-size: 10pt;"> Tel: +85620 5549 8009 ; +85620 9896 2345 </td>
    </tr>
    <tr>
        <td colspan="2" style="padding-left: 10px;font-size: 10pt;"> ເລກປະຈໍາຕົວວິສາຫະກິດ 0366 / ຈທວ
        </td>
        <td style="font-size: 10pt;"> Tax player ID 0366 / ຈທວ
        </td>
    </tr>
    <tr>
        <td colspan="2" style="padding-left: 10px;font-size: 10pt;"> ເລກບັນຊີທະນາຄານການຄ້າຕ່າງປະເທດລາວ
        </td>
        <td style="font-size: 10pt;"> BCEL A/C </td>
    </tr>
    <tr>
        <td colspan="2" style="padding-left: 10px;font-size: 10pt;">
            <table width=100%>
                <tr>
                    <td width="15%">ກີບ</td>
                    <td>010-12-00-01797036-001</td>
                </tr>
            </table>
        </td>
        <td style="font-size: 10pt;">
            <table width=100%>
                <tr>
                    <td width="15%">KIP</td>
                    <td>010-12-00-01797036-001</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="padding-left: 10px;font-size: 10pt;">
            <table width=100%>
                <tr>
                    <td width="15%">ໂດລາ</td>
                    <td>010-12-01-01797036-001</td>
                </tr>
            </table>
        </td>
        <td style="font-size: 10pt;">
            <table width=100%>
                <tr>
                    <td width="15%">USD</td>
                    <td>010-12-01-01797036-001</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="padding-left: 10px;font-size: 10pt;">
            <table width=100%>
                <tr>
                    <td width="15%">ບາດ</td>
                    <td>010-12-02-01797036-001</td>
                </tr>
            </table>
        </td>
        <td style="font-size: 10pt;">
            <table width=100%>
                <tr>
                    <td width="15%">BATH</td>
                    <td>010-12-02-01797036-001</td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td colspan="2" style="padding-left: 10px;font-size: 10pt;"> LUCKXAY CLINIC CO.LTD </td>
        <td style="font-size: 10pt;"> LUCKXAY CLINIC CO.LTD </td>
    </tr>
    <tr>
        <td style="padding-left: 10px;font-size: 10pt;" colspan="3">
            <p>ໄດ້​ຮັບ​ເງິນ​​ຈາກທ່ານ: {{$queue->patient_history_last->patient->user->name}} ອາຍຸ:
                {{$queue->patient_history_last->patient->age}} ປີ,
                ບ້ານ: {{$queue->patient_history_last->patient->village}} ເມືອງ:
                {{$queue->patient_history_last->patient->district}} ແຂວງ:
                {{$queue->patient_history_last->patient->provinceLa ? $queue->patient_history_last->patient->provinceLa->la_name :$queue->patient_history_last->patient->province}}
                ເບີໂທ:
                {{$queue->patient_history_last->patient->user->phone}}
            </p>
        </td>
    </tr>
    <tr>
        <td style="padding-left: 10px;font-size: 10pt;" colspan="3">
            ປິ່ນປົວ​ພະ​ຍາດ:...................................................................................................................
        </td>
    </tr>
    <tr>
        <td style="padding-left: 10px;font-size: 10pt;" colspan="3"> ຕາມ​ລາຍ​ການ​ດັ່ງ​​ຕໍ່ໄປ​ນີ້: </td>

    </tr>
</table>
<div style="height: 20px;"></div>
<table class="table2">
        <tr style="font-size: 12pt;font-weight: bold">
            <th>ລໍາດັບ </th>
            <th>ລາຍການ/Description </th>
            <th>ລາຄາ/ຫົວໝ່ວຍ <br> Unit/price</th>
            <th>ຈຳນວນເງິນ Amount</th>
        </tr>

        @foreach ($prescribeMedicine->prescribeMedicineDetail->where('status','!=','medicine') as $index => $item)
        @if ($item->price > 0)
        <tr style="font-size: 10pt;text-align: center">
            <td>{{$index + 1}}</td>
            <td style="text-align: left ;padding-left: 5px;">{{$item->name}}</td>
            <td style="text-align: right ; padding-right: 5px;">{{$item->amount}} / {{number_format($item->price)}}</td>


            <td style="text-align: right;padding-right: 5px">{{number_format($item->price * $item->amount)}}</td>
        </tr>
        @endif

        @endforeach
        @foreach ($prescribeMedicine->prescribeMedicineDetail->where('status','==','medicine') as $index => $item)
        @if ($item->price)
        <tr style="font-size: 10pt;text-align: center">
            <td>{{$index + 1}}</td>
            <td style="text-align: left ;padding-left: 5px;">{{$item->name}}</td>
            <td style="text-align: right ; padding-right: 5px;">{{$item->amount}} / {{number_format($item->price)}}</td>
            <td style="text-align: right;padding-right: 5px">{{number_format($item->price * $item->amount)}}</td>
        </tr>
        @endif

        @endforeach
        <tr style="font-size: 10pt;text-align: right">
            <td></td>
            <td></td>
            <td></td>
            <td style="padding-right: 20px">-</td>
        </tr>
        <tr>
            <td colspan="3" style="font-size: 13pt;font-weight: bold;text-align: right">ລວມຄ່າກວດທັງໝົດ:</td>
            <td style="font-size: 13pt;text-align: right;padding-right: 5px">{{{number_format($totalLabDetail)}}}</td>
        </tr>
        <tr style="font-size: 10pt">
            <td colspan="3">
                <p style="color: #000">ຄ່າບໍລິການ</p>
            </td>
            <td style="text-align: right;font-size: 10pt;padding-right: 5px"> {{number_format($charge )}}</td>
        </tr>
        <tr style="font-size: 10pt">
            <td colspan="3">
                <p style="color: #000">ຄ່າຢາ</p>
            </td>
            <td style="text-align: right;font-size: 10pt;padding-right: 5px"> {{number_format($totalMedicine )}}</td>
        </tr>

        <tr style="font-size: 10pt">
            <td colspan="3">ສ່ວນຫຼຸດຄ່າກວດ {{$exam_fee_discount}} %
            </td>
            <td style="text-align: right;font-size: 10pt;padding-right: 5px">
                {{number_format(($exam_fee_discount/100)*$totalLabDetail)}}
            </td>
        </tr>
        <tr style="font-size: 10pt">
            <td colspan="3">
                <p style="color: #000">ສ່ວນຫລຸດຄ່າບໍລິການ {{$discounted_services}} %</p>
            </td>
            <td style="text-align: right;font-size: 10pt;padding-right: 5px">
                {{number_format(($discounted_services/100)*$charge)}}</td>
        </tr>
        <tr style="font-size: 10pt">
            <td colspan="3">
                <p style="color: #000"> ສ່ວນຫຼຸດຄ່າຢາ {{$medicine_discount}} %</p>
            </td>
            <td style="text-align: right;font-size: 10pt;padding-right: 5px">
                {{number_format($totalMedicine - (($medicine_discount/100)*$totalMedicine))}}</td>
        </tr>
        <tr style="font-size: 10pt">
            <td colspan="3">
                <p style="color: #000">ສ່ວນຫຼຸດພິເສດ </p>
            </td>
            <td style="text-align: right;font-size: 10pt;padding-right: 5px"> {{$discount_total_money}} %</td>
        </tr>
        <tr style="font-size: 10pt">
            <td colspan="3">
                <p style="color: #ff0000">ທ່ານໝໍຊ່ຽວຊານ</p>
            </td>
            <td style="text-align: right;font-size: 10pt;padding-right: 5px"> {{number_format($doctor_fee )}}</td>
        </tr>

        <tr style="font-size: 10pt">
            <td colspan="3">
                <p style="color: #000">ອາກອນມູນຄ່າເພີ່ມ {{$vat}} %</p>
            </td>
            <td style="text-align: right;font-size: 10pt;padding-right: 5px">{{$vat}}</td>
        </tr>

        <tr style="font-size: 10pt">
            <td colspan="3">
                <p style="color: #000">ຈໍານວນເງິນທັງຫມົດທີ່ຕ້ອງຈ່າຍຕົວຈິງ LAK </p>
            </td>
            <td style="text-align: right;font-size: 10pt;padding-right: 5px">
                {{number_format($money - (($discount_total_money/100)*$money))}} </td>
        </tr>
        <tr style="font-size: 10pt">
            <td colspan="3">
                <p style="color: #000">ຈໍານວນເງິນທັງຫມົດທີ່ຕ້ອງຈ່າຍຕົວຈິງ USD </p>
            </td>
            <td style="text-align: right;font-size: 10pt;padding-right: 5px">
                {{number_format($usd - (($discount_total_money/100)*$usd))}} </td>
        </tr>
        <tr style="font-size: 10pt">
            <td colspan="3">
                <p style="color: #000">ຈໍານວນເງິນທັງຫມົດທີ່ຕ້ອງຈ່າຍຕົວຈິງ THB </p>
            </td>
            <td style="text-align: right;font-size: 10pt;padding-right: 5px">
                {{number_format($thb - (($discount_total_money/100)*$thb))}} </td>
        </tr>



</table>


<div style="height: 50px"></div>


<table class="table1" style="font-size: 12px">
    <tr>
        <td>ວັນທີ Date:……………………………………..
        </td>
        <td>ວັນທີ Date:………………………………….
        </td>
    </tr>
    <tr>
        <td>ລາຍເຊັນຜູ້ຮັບເງິນ / Cashier:...........................

        </td>
        <td>ລາຍເຊັນຜູ້ຈ່າຍເງິນ / Player:.........................

        </td>
    </tr>
</table>

@endsection

@section('script')

<script type="text/javascript">
    window.onload = function() { window.print() }
</script>
@endsection
