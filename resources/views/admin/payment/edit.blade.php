@extends('admin.layout.default')

@section('title', trans('admin.queue.actions.edit', ['name' => $queue->id]))

@section('body')

<div class="container-xl">

    <queue-form :action="'{{ $queue->resource_url }}'" :status="'{{$status}}'" :data="{{ $queue->toJson() }}" v-cloak
        inline-template>

        <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>
            @include('admin.partials.modal.modal',['name'=>'pay','body'=>view('admin.payment.components.modal.pay',['queue'=>$queue,'wages'=>$wages])])
            <div class="card">


                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            Queue: @{{form.id}} <br>
                            Patient:
                            @{{form.patient ? form.patient.user.full_name_phone :form.patientHistory.patient.user.full_name_phone}}
                        </div>
                        <div class="col-6">
                            Doctor: @{{form.employee.lao_first_name}}
                        </div>
                    </div>
                </div>

                <table class="table table-responsive-sm table-bordered">
                    <thead>
                        <tr>
                            <th>ລໍາດັບ</th>
                            <th>ລາຍການ/Description </th>
                            <th>ລາຄາ </th>
                            <th>ຈໍານວນ </th>
                            <th>ປະເພດ </th>
                            <th>ຈໍານວນເງິນ </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prescribeMedicine->prescribeMedicineDetail->where('status','!=','medicine') as $index
                        => $item)
                        @if ($item->price > 0)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->amount}}</td>
                            <td>{{$item->status == 'medicine' ? 'ຄ່າຢາ':($item->status == 'package' ? 'Package' :'ຄ່າກວດ')}}
                            </td>
                            <td>{{$item->amount * $item->price}}</td>

                        </tr>
                        @endif

                        @endforeach
                        <tr>
                            <td colspan="5">ລວມຄ່າກວດທັງໝົດ:</td>
                            <td>{{{number_format($totalLabDetail)}}}</td>
                        </tr>
                        <tr>
                            <td colspan="5">ສ່ວນຫຼຸດຄ່າກວດຫຼຸດ {{$exam_fee_discount}} %
                            </td>
                            <td>
                                {{number_format($totalLabDetail - (($exam_fee_discount/100)*$totalLabDetail))}}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-responsive-sm table-bordered">
                    <thead>
                        <tr>
                            <th>ລໍາດັບ</th>
                            <th>ລາຍການ/Description </th>
                            <th>ລາຄາ </th>
                            <th>ຈໍານວນ </th>
                            <th>ປະເພດ </th>
                            <th>ຈໍານວນເງິນ </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prescribeMedicine->prescribeMedicineDetail->where('status','==','medicine') as $index
                        => $item)
                        @if ($item->price > 0)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->amount}}</td>
                            <td>{{$item->status == 'medicine' ? 'ຄ່າຢາ':($item->status == 'package' ? 'Package' :'ຄ່າກວດ')}}
                            </td>
                            <td>{{number_format($item->amount * $item->price)}}</td>

                        </tr>
                         @endif
                        @endforeach
                        <tr>
                            <td colspan="5">ລວມຄ່າກວດທັງໝົດ:</td>
                            <td>{{{number_format($totalMedicine)}}}</td>
                        </tr>
                        <tr>
                            <td colspan="5">ສ່ວນຫຼຸດຄ່າຢາ {{$medicine_discount}} %
                            </td>
                            <td>
                                {{number_format($totalMedicine - (($medicine_discount/100)*$totalMedicine))}}
                            </td>
                        </tr>
                    </tbody>
                </table>



                <table class="table table-responsive-sm table-bordered">

                    <tr>
                        <td colspan="5">ຄ່າບໍລິການ</td>
                        <td>{{number_format($charge)}}</td>
                    </tr>
                    <tr>
                        <td colspan="5">ຄ່າຢາ</td>
                        <td>{{number_format($totalMedicine)}}</td>
                    </tr>
                    <tr>
                        <td colspan="5">ທ່ານໝໍຊ່ຽວຊານ</td>
                        <td>
                            {{number_format($doctor_fee)}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">ສ່ວນຫຼຸດຄ່າບໍລິການ
                            {{$discounted_services}} % </td>
                        <td>
                            {{number_format($charge - (($discounted_services/100)*$charge))}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">ສ່ວນຫຼຸດຄ່າຢາ
                            {{$medicine_discount}} % </td>
                        <td>
                            {{number_format($totalMedicine - (($medicine_discount/100)*$totalMedicine))}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">ສ່ວນຫຼຸດທ່ານໝໍຊ່ຽວຊານ
                            {{$doctor_fee_discount}} % </td>
                        <td>
                            {{number_format($doctor_fee - (($doctor_fee_discount/100)*$doctor_fee))}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">ອາກອນມູນຄ່າເພີ່ມ {{$vat }}% </td>
                        <td>{{$vat}}</td>
                    </tr>

                    <tr>
                        <td colspan="5">ຈຳນວນເງິນທີ່ຕ້ອງຈ່າຍຕົວຈີງ:</td>
                        <td>
                            {{$money}}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="5">ຈຳນວນເງິນທີ່ຕ້ອງຈ່າຍຕົວຈີງເປັນ THB:</td>
                        <td>
                            {{$thb}}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="5">ຈຳນວນເງິນທີ່ຕ້ອງຈ່າຍຕົວຈີງເປັນ USD:</td>
                        <td>
                            {{$usd}}
                        </td>
                    </tr>
                </table>

                <div class="card-footer">
                    @if ($status == 'package')
                    <button type="button" @click.prevent="show()" v-if="'{{$queue->status}}' != 'pay_already'"
                        class="btn btn-primary">
                        {{ __('Pay') }}
                    </button>
                    <button type="button" @click.prevent="onPrint({{$queue->id}})"
                        v-if="'{{$queue->status}}' == 'pay_already'" class="btn btn-primary">
                        {{ __('Print') }}
                    </button>
                    <a href="{{url('/admin/payments')}}" v-if="'{{$queue->status}}' == 'pay_already'"
                        class="btn btn-warning">
                        Finished
                    </a>
                    @else
                    <button type="button" @click.prevent="show()" v-if="'{{$queue->queues_status}}' != 'pay_already'"
                        class="btn btn-primary">
                        {{ __('Pay') }}
                    </button>
                    <button type="button" @click.prevent="onPrint({{$queue->id}})"
                        v-if="'{{$queue->queues_status}}' == 'pay_already'" class="btn btn-primary">
                        {{ __('Print') }}
                    </button>

                    <a href="{{url('/admin/payments')}}" v-if="'{{$queue->queues_status}}' == 'pay_already'"
                        class="btn btn-warning">
                        Finished
                    </a>
                    @endif



                </div>
            </div>

            <iframe v-if="print" :src="print" class="d-none"></iframe>

        </form>

    </queue-form>


</div>

@endsection
