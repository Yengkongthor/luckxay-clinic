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
        border: 0px solid #000;
        border-collapse: collapse;
    }

    .header tr,
    td {
        /* border: 1px solid black; */
        height: 30px;
    }

    .header {
        border-collapse: collapse;
        width: 100%;
    }
</style>
@endsection

@section('body')

<table class="header">
    <tr>
        <td style="width: 10%"><img src="{{asset('images/logo/logo.jpg')}}" alt="" srcset="" width="80px"></td>
        <td style="text-align: center;">
            ໃບກວດ
        </td>
    </tr>
</table>

<table class="table2" style="padding: 0px">
    <tbody>
        <tr>
            <td>Patient ID : {{$queue->patient->id}}</td>
            <td>Name: {{$queue->patient->lao_first_name}}</td>
            <td>Surname: {{$queue->patient->lao_last_name}}</td>
            <td>gender: {{$queue->patient->gender}}</td>
        </tr>
        <tr>
            <td>Birth date {{ date('d-m-Y', strtotime($queue->patient->birth_date))}}</td>
            <td>Age {{$queue->patient->age}}</td>
            <td>Address: ...</td>
            <td>village: {{$queue->patient->village}}</td>
        </tr>
        <tr>
            <td>district: {{$queue->patient->district}}</td>
            <td>province : {{$queue->patient->province}}</td>
            <td>tell: {{$queue->patient->user->phone}}</td>
        </tr>
    </tbody>
</table>


<p>Examination Result: {{ $queue->patient_history_last->test_at }}</p>

<table class="table1">
    <thead>
        <tr>
            <th> Examination </th>
            <th> Value </th>

        <tr>
    </thead>
    <tbody>
        @foreach ($examinationServicesResult as $item)
        <tr>
            <td>{{ $item->labDetail->name  }} </td>
            <td>{{ $item->value }}</td>
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
