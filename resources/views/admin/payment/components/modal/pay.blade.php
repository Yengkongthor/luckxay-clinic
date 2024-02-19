<div class="col-sm-12">
    <div class="form-group">
        <label for="name">ຄ່າບໍລິການ</label>
        {{-- <input class="form-control" id="name" type="number" v-model="charge" placeholder="ຄ່າບໍລິການ"> --}}
        <select class="form-control" id="select1" name="select1" v-model="charge">
            <option :value="item.price" v-for="(item,index) in {{$wages}}">@{{item.price}} Kip</option>
        </select>

    </div>
</div>
<div class="col-sm-12">
    <div class="form-group">
        <label for="name">ສ່ວນຫຼຸດຄ່າກວດ ເປັນ % </label>
        <input class="form-control" id="name" type="number" v-model="exam_fee_discount"
            placeholder="ສ່ວນຫຼຸດຄ່າກວດຫຼຸດ">
    </div>
</div>
<div class="col-sm-12">
    <div class="form-group">
        <label for="name">ສ່ວນຫຼຸດຄ່າບໍລິການ ເປັນ %</label>
        <input class="form-control" id="name" type="number" v-model="discounted_services"
            placeholder="ສ່ວນຫຼຸດຄ່າບໍລິການຫຼຸດ">
    </div>
</div>
<div class="col-sm-12">
    <div class="form-group">
        <label for="name">ສ່ວນຫຼຸດຄ່າຢາ ເປັນ %</label>
        <input class="form-control" id="name" type="number" v-model="medicine_discount"
            placeholder="ສ່ວນຫຼຸດຄ່າຢາ">
    </div>
</div>

<div class="col-sm-12">
    <div class="form-group">
        <label for="name">ອາກອນມູນຄ່າເພີ່ມ ເປັນ % </label>
        <input class="form-control" id="name" type="number" v-model="vat" placeholder="ອາກອນມູນຄ່າເພີ່ມ">
    </div>
</div>

<div class="col-sm-12">
    <div class="form-group">
        <label for="name">ສ່ວນຫຼຸດລວມທັງໝົດ</label>
        <input class="form-control" id="name" type="number" v-model="discount_total_money" placeholder="ສ່ວນຫຼຸດລວມທັງໝົດ">
    </div>
</div>

<button class="btn btn-sm btn-primary" type="button" @click.prevent="onPay({{$queue->id}})">
    Pay</button>
