@extends('admin.reports.defult')
@section('css')
<style>
    /* table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    } */

    table {
        border: 2px solid rgb(103, 176, 235);
        border-radius: 5px;
        width: 100%;
        margin-top: 20px;
    }

    ul li {
        display: inline;
        padding-right: 10px;
    }
</style>
@endsection

@section('body')
@foreach ($doctorMedicines as $item)
<table>
    <tr style="height: 80px;text-align: center;">
        <td><img src="{{asset('images/logo/logo.jpg')}}" alt="" srcset="" width="80"></td>
        <td style="padding-right: 20% ;padding-left: 20%">
            <p
                style="border: 3px solid rgb(103, 176, 235);border-radius: 10px; background-color: rgb(103, 176, 235);color: #fff;">
                ຫຼັກໄຊ
                ຄີລນິກ
                <br>Luckxay Clinic
            </p>
        </td>
    </tr>
    <tr style="text-align: center">
        <td>ຊື່(Name):</td>
        <td>{{$patient_name}}</td>
    </tr>
    <tr style="text-align: center">
        <td>ວັນທີ:</td>
        <td> {{now()}}</td>
    </tr>
    <tr style="text-align: center">
        <td>ຊື່ຢາ(Drug): </td>
        <td>{{$item->cheminal_name}} </td>
    </tr>
    <tr>
        <td style="text-align: center">ເວລາ/Time:</td>
        <td>
            <ul style="margin: 0">
                <li>{!!in_array('morning',$item->times) ? '&#9745;':'&#9744;'!!} ເຊົ້າ (Morning)</li>
                <li>{!!in_array('afternoon',$item->times) ? '&#9745;':'&#9744;'!!} ສວາຍ (Afternoon)</li>
                <li>{!!in_array('evening',$item->times) ? '&#9745;':'&#9744;'!!} ແລງ Evening</li>
                <li>{!!in_array('before_bedtime',$item->times) ? '&#9745;':'&#9744;'!!} ກ່ອນນອນ Before Bedtime</li>

            </ul>
        </td>
    </tr>
    <tr>
        <td style="text-align: center">Tablets/Capsules:</td>
        <td>
            <ul style="margin: 0">
                <li>{!!in_array('before_meals',$item->tablets) ? '&#9745;':'&#9744;'!!} ກ່ອນອາຫານ (Before meals)</li>
                <li>{!!in_array('after_meals',$item->tablets) ? '&#9745;':'&#9744;'!!} ຫຼັງອາຫານ (After meals)</li>
                <li>{!!in_array('3_minutes',$item->tablets) ? '&#9745;':'&#9744;'!!} 3 ນາທີ</li>
                <li>{!!in_array('30_minutes',$item->tablets) ? '&#9745;':'&#9744;'!!} 30 ນາທີ</li>

            </ul>
        </td>

    </tr>
    <tr>
        <td colspan="2" style="text-align: center">
            <p style="background-color: rgb(103, 176, 235); border-radius: 5px;margin: 0;color: #fff;">Avenue Kaysone
                Phomvihane,Xangkhu
                Village, Xaythany District, Vientiane, Lao </p>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <ul style="text-align: center">
                <li>Tel:</li>
                <li style="margin-right: 50px">+856 20 55498009</li>
                <li>+856 20 98962345</li>
            </ul>

        </td>

    </tr>
</table>
@endforeach

@endsection

@section('script')

<script type="text/javascript">
    window.onload = function() { window.print() }
</script>
@endsection
