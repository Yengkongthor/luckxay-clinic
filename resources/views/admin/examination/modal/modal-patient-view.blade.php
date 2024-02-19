<p>Luckxay clinic patient observation</p>

<div class="row">
    <div class="col">
        <p>patient ID: @{{patient.patient_code}}</p>
        <p>Name: @{{patient.user ? patient.user.name :''}}</p>
        <p>surname: @{{patient.user ? patient.user.surname : ''}}</p>
        <p>gender: @{{patient.gender}}</p>
        <p>Birth date : @{{patient.birth_date | date}}</p>
        <p>age : @{{patient.age}}</p>
    </div>
    <div class="col">
        <p>village : @{{patient.village}}</p>
        <p>district : @{{patient.district}}</p>
        <p>province : @{{patient.province}}</p>
        <p>tell : @{{patient.user ? patient.user.phone:'' }}</p>
    </div>
</div>
<div class="row">
    <div class="col">
        <table class="table table-responsive-sm table-sm">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Unit</th>
                    <th>Reference</th>
                    <th>value</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item,index) in examination_lab">
                    <td>@{{item.lab_detail_name}}</td>
                    <td>@{{item.lab_detail_unit}}</td>
                    <td>@{{item.lab_detail_reference}}</td>
                    <td>@{{item.value}}</td>
                </tr>

            </tbody>
        </table>
    </div>
    <div class="col">
        <table class="table table-responsive-sm table-sm">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>value</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item,index) in information_history_detail" v-if="item.key">
                    <td>@{{titleCase(item.key)}}</td>
                    <td>@{{item.value == 1 ? 'Yes' : item.value}}</td>
                </tr>

            </tbody>
        </table>
    </div>
    <div class="col-12">
        Medicine
        <div class="row">
            <div class="col" v-for="(item,index) in  history_medicine">@{{item.name}} ຈຳນວນ: @{{item.amount}}</div>
        </div>
    </div>
    <div class="col-12 mt-1">
        <h5>Comment Result</h5>
        <p>@{{queue_comment | striphtml}}</p>
    </div>
</div>



<button class="btn btn-danger btn-sm" @click.prevent="hideModalPatientHistoryView">Close</button>
