@extends('admin.reports.defult')
@section('css')
<style>
    @media screen,
    print {

        html,
        body {
            /* height: 100% !important; */
            padding: 0;
            margin: 0;
        }

        .bordered {
            border: 2px solid;
            border-radius: 5px;
            margin: 5px;
            position: absolute;
            left: 5px;
            top: 5px;
            right: 5px;
            bottom: 5px;
            /* height: 100%; */
        }

        table {
            width: 100%;
            font-size: 11pt;
            /* margin-top: 10px; */
        }

        ul li {
            display: inline;
            padding-right: 10px;
        }

        .border-customize {
            border: 1px solid;
            border-radius: 5px;
            width: 100%;
            padding: 5px;
        }



        span {
            display: inline-block;
        }

        .center {
            text-align: center;
        }
    }
</style>
@endsection

@section('body')

<div class="bordered">
    <table>
        <tr>
            <td width="30%"><img src="{{asset('images/logo/logo-luckxay-black-01.png')}}" width="40"></td>
            <td>
                <div class="border-customize center">
                    ຫຼັກໄຊ ຄີລນິກ <br> Luckxay Clinic
                </div>
            </td>
            <td width="30%"></td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="30%">ຊື່(Name):</td>
            <td>{{$patient_name}}</td>
        </tr>
        <tr>
            <td>ວັນທີ:</td>
            <td> {{now()}}</td>
        </tr>
        <tr>
            <td>ຊື່ຢາ(Drug): </td>
            <td>{{$doctorMedicines->cheminal_name}} ປະເພດ: {{$doctorMedicines->type}} </td>
        </tr>
    </table>
    <table style="font-weight: bold ; font-size: 12pt">
        <tr>
            <td> Dose: </td>
            <td>
                {{$doctorMedicines->dose}}
            </td>
        </tr>
        <tr>
            <td> ກິນ: </td>
            <td>
                {{$doctorMedicines->use}}
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top">ເວລາ/Time:</td>
            <td>

                <span>{!!in_array('morning',$doctorMedicines->times) ? '&#9745;':'&#9744;'!!} ເຊົ້າ (Morning)</span>
                <span>{!!in_array('afternoon',$doctorMedicines->times) ? '&#9745;':'&#9744;'!!} ສວາຍ (Afternoon)</span>
                <span>{!!in_array('evening',$doctorMedicines->times) ? '&#9745;':'&#9744;'!!} ແລງ Evening</span>
                <span>{!!in_array('before_bedtime',$doctorMedicines->times) ? '&#9745;':'&#9744;'!!} ກ່ອນນອນ Before Bedtime</span>


            </td>
        </tr>
        <tr>
            <td style="vertical-align: top">ເມັດ/ແຄັບຊູນ:</td>
            <td>
                <span>{!!in_array('before_meals',$doctorMedicines->tablets) ? '&#9745;':'&#9744;'!!} ກ່ອນອາຫານ (Before
                    meals)</span>
                <span>{!!in_array('after_meals',$doctorMedicines->tablets) ? '&#9745;':'&#9744;'!!} ຫຼັງອາຫານ (After meals)</span>
                <span>{!!in_array('3_minutes',$doctorMedicines->tablets) ? '&#9745;':'&#9744;'!!} 3 ນາທີ</span>
                <span>{!!in_array('30_minutes',$doctorMedicines->tablets) ? '&#9745;':'&#9744;'!!} 30 ນາທີ</span>
            </td>
        </tr>
    </table>
    <div style="height: 15px"></div>
    <table>
        <tr>
            <td colspan="2">

                <p class="center" style="margin: 0;padding: 0;">Avenue Kaysone Phomvihane,Xangkhu Village, Xaythany
                    District, Vientiane, Lao</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p class="center" style="margin: 0;padding: 0;"> Tel: +856 20 55498009, +856 20 98962345</p>

            </td>

        </tr>
    </table>
</div>
<p style="page-break-after: always;"></p>



@endsection

@section('script')

<script type="text/javascript">
    window.onload = function() { window.print() }
</script>
@endsection
