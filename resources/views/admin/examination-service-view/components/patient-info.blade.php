<div class="row">
    <div class="col-6">
        Lao First Name :{{$patientHistory->patient->user->name}}
    </div>
    <div class="col-6">
        Lao Last Name :{{$patientHistory->patient->user->surname}}
    </div>
    <div class="col-6">
        Birth date :{{ date('j F, Y', strtotime($patientHistory->patient->birth_date))}}
    </div>
    <div class="col-6">
        Age :{{$patientHistory->patient->age}}
    </div>
    <div class="col-6">
        Gender :{{$patientHistory->patient->gender}}
    </div>

    <div class="col-6">
        Village :{{$patientHistory->patient->village}}
    </div>
    <div class="col-6">
        District :{{$patientHistory->patient->district}}
    </div>
    <div class="col-6">
        Province :{{$patientHistory->patient->province}}
    </div>
    <div class="col-6">
        Phone :{{$patientHistory->patient->user->phone}}
    </div>
</div>
