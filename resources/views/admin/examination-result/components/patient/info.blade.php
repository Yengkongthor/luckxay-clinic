<div class="row">
    <div class="col-6">
        Patient ID : @{{data.patient.patient_code}}
    </div>
    <div class="col-6">
        Lao First Name : @{{data.patient.user.name}}
    </div>
    <div class="col-6">
        Lao Last Name : @{{data.patient.user.surname}}
    </div>
    <div class="col-6">
        Nick name : @{{data.patient.nick_name}}
    </div>
    <div class="col-6">
        Birth date : @{{data.patient.birth_date | date}}
    </div>
    <div class="col-6">
        Age : @{{data.patient.age}}
    </div>
    <div class="col-6">
        Gender : @{{data.patient.gender}}
    </div>

    <div class="col-6">
        Village : @{{data.patient.village}}
    </div>
    <div class="col-6">
        District : @{{data.patient.district}}
    </div>
    <div class="col-6">
        Province : @{{data.patient.province}}
    </div>
    <div class="col-6">
        Phone : @{{data.patient.user.phone}}
    </div>
</div>
