<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CoreUI CSS -->

    <title>ໃບສັ່ງກວດ</title>
    <link rel="stylesheet" href="{{asset('/css/admin.css')}}">
    <style>
        .list-group-item {

            padding: 0 !important;
            border: 0px solid rgba(0, 0, 0, .125) !important;
        }

        .card {
            border: none !important;
        }


        .card-columns .card {
            margin-bottom: 0 !important;
        }

        .font-style {
            font-size: 12pt !important;
        }

        body {
            background-color: #fff;
            font-family: 'Times New Roman', Times, serif !important;

        }

        .border {
            border: 1px solid #000 !important;
        }

        @media (min-width:356px) {
            .card-columns {
                column-count: 6;
            }
        }

        @media (min-width:576px) {
            .card-columns {
                column-count: 6;
            }
        }

        @media (min-width:768px) {
            .card-columns {
                column-count: 6;
            }
        }

        @media (min-width:992px) {
            .card-columns {
                column-count: 4;
            }
        }

        @media (min-width:1200px) {
            .card-columns {
                column-count: 6;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-sm">
                <img src="{{ url('/images/logo/logo-exam.png')}}" class="img-fluid" alt="...">
            </div>
            <div class="col-sm text-right">
                <p> ເລກທີ:....................... </p>
                <p>ວັນທີ:....../..../........... </p>
                <p>ຫນ່ວຍງານ :....................... </p>
            </div>


        </div>

        <div class="row">
            <div class="col text-center">
                <h3>ໃບສັ່ງກວດ</h3>
            </div>
        </div>
        <div class="row">
            <div class="col text-center" class="font-style">
                <p>ຊື່
                    ນາມສະກຸນ:..............................
                    .................................................................,ວັນ
                    ເດືອນ ປີ:.........../.........../.....................ອາຍຸ:...................,ປີ</p>
                <p>ປະຈຸບັນຢູ່ບ້ານ:...............................................,ເມືອງ:..................................,ແຂວງ.................................,ເບີໂທ..............................................
                </p>
                <p>ມະຕິພະຍາດ:...............................................................................................................................................................................................
                </p>
            </div>
        </div>
        <p class="d-none">{{$i = 1}}</p>
        <div class="card-columns  mb-5">
            @foreach ($services as $index => $item)
            <div class="card pl-3 pt-2" style="width: 18rem;">
                <div class="card-body p-0">
                    <h5 class="card-title m-1" style="font-weight: bold">{{$item->name}}</h5>
                    @foreach ($item->labDetailService as $index => $item)

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">☐{{$i}}. {{$item->name}}</li>
                    </ul>
                    <p class="d-none">{{$i++}}</p>
                    @endforeach
                </div>
            </div>

            @endforeach

        </div>

        <div class="row">
            <div class="col">
                <p>ຈໍານວນລາຍການກວດທັງຫມົດ..................ລາຍການ</p>
            </div>
            <div class="col text-right">
                <p>ວັນທີ......../......../................</p>
                <p>ຊື່ ແລະ ລາຍເຊັນໝໍ</p>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        window.onload = function() { window.print() }
    </script>
</body>


</html>
