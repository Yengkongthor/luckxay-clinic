@extends('admin.reports.defult')
@section('css')
<style>
    /* table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    } */

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
            font-size: 4.5pt;
            /* margin-top: 5px; */
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

        .right {
            text-align: right;
        }

        .left {
            text-align: left;
        }
    }
</style>
@endsection

@section('body')
<div class="bordered">
    <table style="width: 100%">
        <tr>
            <td width="30%"><img src="{{asset('images/logo/logo-luckxay-black-01.png')}}" width="20"></td>
            <td>
                <div class="border-customize center">
                    ຫຼັກໄຊ ຄີລນິກ <br> Luckxay Clinic
                </div>
            </td>
            <td width="30%"></td>
        </tr>
    </table>

    <table style="width: 100%">
        <tr>
            <td width="50%">ຊື່ຄົນເຈັບ:
            <td>
            <td width="25%">ອາຍຸ:
            <td>
            <td width="25%">ຕຽງນອນ:
            <td>
        </tr>
    </table>

    <table style="width: 100%">
        <tr>
            <td width="50%">ຊື່ສານນ້ຳ........................</td>
            <td width="50%">ນ້ຳເບີ...........................</td>
        </tr>
    </table>

    <table style="width: 100%">
        <tr>
            <td>ຊື່ຢາທີ່ປະສົມ..................................................................................................................
            </td>
        </tr>
        <tr>
            <td>..................................................................................................................................
            </td>
        </tr>
        <tr>
            <td>..................................................................................................................................
            </td>
        </tr>


    </table>
    <table style="width: 100%">
        <tr>
            <td width="50%">ເວລາເລີ່ມ......................................</td>
            <td width="50%">ວັນທີ......../......../........</td>
        </tr>
    </table>
    <table style="width: 100%">
        <tr>
            <td>ໃຊ້ເວລາ.................................ຊົ່ວໂມງ,</td>
            <td><span>&#11036;</span> ຈຳນວນຢອດ/ນາທີ</td>
        </tr>
    </table>
    <table style="width: 100%">
        <tr>
            <td colspan="3">ຜູ້ກຽມຢາ:......................................</td>
        </tr>
    </table>
    <table style="width: 100%">
        <tr>
            <td style="width: 50%">ເວລາຫມົດ......................................</td>
            <td>ວັນທີ......../......../........</td>
        </tr>
    </table>
</div>
@endsection
@section('script')

<script type="text/javascript">
    window.onload = function() { window.print() }
</script>
@endsection
