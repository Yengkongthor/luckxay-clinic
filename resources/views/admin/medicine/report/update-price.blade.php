@extends('admin.layout.default')


@section('title', 'Update Price')

@section('body')
<medicine-report-listing :data="{{ $medicineHistory->toJson() }}" :url="'{{ url('admin/medicines') }}'" inline-template
    v-cloak>
    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> Medicines Update Price</div>
        <div class="card-body">
            <table class="table table-responsive-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>old Price</th>
                        <th>New Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item,index) in collection">
                        <td>@{{index}}</td>
                        <td>@{{item.medicine ? item.medicine.cheminal_name : ''}}</td>
                        <td>@{{item.medicine ? item.medicine.price : '0'}}</td>
                        <td>@{{item.price}}</td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary  btn-sm pull-right m-b-0 mr-1" type="button" @click.prevent="onApproved">
                {{ __('Approved Price') }}</button>
        </div>
    </div>
</medicine-report-listing>
@endsection
