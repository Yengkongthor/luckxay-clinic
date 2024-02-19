@extends('admin.layout.default')

@section('title', trans('admin.queue.actions.edit', ['name' => $queue->id]))

@section('body')


<div>
    <queue-form queue-id="{{$queue->id}}" :action="'{{ $queue->resource_url }}'" :data="{{ $queue->toJson() }}" v-cloak
        inline-template>
        <div class="row">
            @include('admin.partials.modal.modal',['name'=>'sticker','beforeOpen'=>'beforeOpen','body'=>view('admin.prescribe-medicine.modals.prescribe-medicine')])
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <label for="note">Medicine</label>

                        <button class="btn btn-primary btn-sm float-right"
                            @click.prevnet="showModalPrintSticker({{$queue->patient_history_last->doctorMedicines}})">ພິມສະຕິກເກີ</button>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($queue->patient_history_last->doctorMedicines as $item)
                            <li class="list-group-item">ຊື່: {{$item?  $item->cheminal_name : ''}} ຈຳນວນ:
                                {{$item->amount}} ປະເພດ :
                                {{$item->medicine->category->name ?? 'ບໍ່ມີ'}} Dose:
                                {{$item->medicine ? $item->medicine->dose : ''}}


                            </li>
                            @endforeach
                        </ul>
                        @if ($queue->patient_history_last->doctorMedicines->count() == 0)
                        ບໍ່ມີຢາ
                        @endif
                    </div>
                </div>
            </div>
            <iframe :src="printMedicine" v-if="printMedicine" class="d-none"></iframe>

        </div>
    </queue-form>
    <div class="row">

        <div class="col-6">

            @include('admin.prescribe-medicine.components.medicine',['data'=>$dataMedicine,'url'=>'/admin/prescribe-medicines/medicines'])
        </div>
        <div class="col-6">
            @include('admin.prescribe-medicine.components.shopping-cart',['data'=>$datashoppingCart,'url'=>'/admin/prescribe-medicines/shopping-cart','queueId'=>$queue->id,'status'=>'queue','noMedicine'=>$queue->patient_history_last->doctorMedicines->count()])
        </div>
    </div>


</div>

@endsection
