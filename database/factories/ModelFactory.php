<?php

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Brackets\AdminAuth\Models\AdminUser::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'activated' => true,
        'forbidden' => $faker->boolean(),
        'language' => 'en',
        'deleted_at' => null,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,

    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'email_verified_at' => $faker->dateTime,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,

    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Department::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});


/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\PatientHistory::class, static function (Faker\Generator $faker) {
    return [
        'patient_id' => $faker->randomNumber(5),
        'weight' => $faker->randomFloat,
        'temperature' => $faker->randomFloat,
        'test_at' => $faker->date(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Queue::class, static function (Faker\Generator $faker) {
    return [
        'patient_id' => $faker->randomNumber(5),
        'doctor_id' => $faker->randomNumber(5),
        'queues_status' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\BookAnAppointment::class, static function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->randomNumber(5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Queue::class, static function (Faker\Generator $faker) {
    return [
        'patient_id' => $faker->randomNumber(5),
        'employee_id' => $faker->randomNumber(5),
        'queues_status' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'comment' => $faker->text(),
    ];
});


/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Patient::class, static function (Faker\Generator $faker) use ($factory) {
    return [
        'user_id' => $factory->create(App\Models\User::class)->id,
        'lao_first_name' => $faker->firstName,
        'lao_last_name' => $faker->firstName,
        'age' => $faker->randomDigit,
        'gender'=> '',
        'province'=>$faker->city,
        'district'=>$faker->state,
        'village'=>$faker->address,
        'marital_status'=>$faker->sentence,
        'blood_group'=>$faker->city,
        'nick_name'=>$faker->name,
        'birth_date'=>'',
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Medicine::class, static function (Faker\Generator $faker) {
    return [
        'brand_name' => $faker->sentence,
        'cheminal_name' => $faker->sentence,
        'dose' => $faker->sentence,
        'type' => $faker->sentence,
        'manufacture_date' => $faker->date(),
        'best_before_date' => $faker->date(),
        'cose' => $faker->randomFloat,
        'price' => $faker->randomFloat,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Department::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'department_code' => $faker->sentence,
        'department_phone' => $faker->phoneNumber,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\BookingTime::class, static function (Faker\Generator $faker) {
    return [
        'start_time' => $faker->time(),
        'end_time' => $faker->time(),
        'status_time' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\EmployeeStatus::class, static function (Faker\Generator $faker) {
    return [
        'employee_id' => $faker->randomNumber(5),
        'queue_id' => $faker->randomNumber(5),
        'employee_status' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\EmployeeStatus::class, static function (Faker\Generator $faker) {
    return [
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\EmployeeStatus::class, static function (Faker\Generator $faker) {
    return [
        'employee_id' => $faker->randomNumber(5),
        'queue_id' => $faker->randomNumber(5),
        'employee_status' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\EmployeeStatus::class, static function (Faker\Generator $faker) {
    return [
        'employee_id' => $faker->randomNumber(5),
        'queue_id' => $faker->randomNumber(5),
        'status' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Lab::class, static function (Faker\Generator $faker) {
    return [
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Lab::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Medicine::class, static function (Faker\Generator $faker) {
    return [
        'brand_name' => $faker->sentence,
        'cheminal_name' => $faker->sentence,
        'dose' => $faker->sentence,
        'type' => $faker->sentence,
        'manufacture_date' => $faker->date(),
        'best_before_date' => $faker->date(),
        'cost' => $faker->randomFloat,
        'price' => $faker->randomFloat,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\LabDetail::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'unit' => $faker->sentence,
        'reference' => $faker->sentence,
        'cost' => $faker->randomFloat,
        'price' => $faker->randomFloat,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\LabDetail::class, static function (Faker\Generator $faker) {
    return [
        'lab_id' => $faker->randomNumber(5),
        'name' => $faker->firstName,
        'unit' => $faker->sentence,
        'reference' => $faker->sentence,
        'cost' => $faker->randomFloat,
        'price' => $faker->randomFloat,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Service::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'price' => $faker->randomFloat,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\ExcludeDate::class, static function (Faker\Generator $faker) {
    return [
        'exclude_dates' => $faker->date(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\BookingDate::class, static function (Faker\Generator $faker) {
    return [
        'last_date' => $faker->date(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\ExcludeDate::class, static function (Faker\Generator $faker) {
    return [
        'date' => $faker->date(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\BookingDate::class, static function (Faker\Generator $faker) {
    return [
        'last_date' => $faker->randomNumber(5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\ExcludeDate::class, static function (Faker\Generator $faker) {
    return [
        'created_at' => $faker->dateTime,
        'date' => $faker->date(),
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Branch::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'addres' => $faker->sentence,
        'tel' => $faker->sentence,
        'email' => $faker->email,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Branch::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'addres' => $faker->sentence,
        'map' => $faker->sentence,
        'tel' => $faker->sentence,
        'email' => $faker->email,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Promotion::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'image' => $faker->sentence,
        'link' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Promotion::class, static function (Faker\Generator $faker) {
    return [
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Promotion::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'short_desc' => $faker->sentence,
        'link' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\HealthTip::class, static function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'short_desc' => $faker->sentence,
        'detail' => $faker->text(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\ExaminationService::class, static function (Faker\Generator $faker) {
    return [
        'patient_history_id' => $faker->randomNumber(5),
        'service_id' => $faker->randomNumber(5),
        'lab_id' => $faker->randomNumber(5),
        'lab_detail_id' => $faker->randomNumber(5),
        'value' => $faker->randomFloat,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\BasicPhysicalExamination::class, static function (Faker\Generator $faker) {
    return [
        'patient_id' => $faker->randomNumber(5),
        'pressure' => $faker->randomFloat,
        'weight' => $faker->randomFloat,
        'temperature' => $faker->randomFloat,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Upload::class, static function (Faker\Generator $faker) {
    return [
        'created_at' => $faker->dateTime,
        'lab_id' => $faker->randomNumber(5),
        'patient_history_id' => $faker->randomNumber(5),
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\MedicineHistory::class, static function (Faker\Generator $faker) {
    return [
        'medicine_id' => $faker->randomNumber(5),
        'cost' => $faker->randomFloat,
        'price' => $faker->randomFloat,
        'status_approved' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\ShoppingCart::class, static function (Faker\Generator $faker) {
    return [
        'medicine_id' => $faker->randomNumber(5),
        'cost' => $faker->randomFloat,
        'price' => $faker->randomFloat,
        'amount' => $faker->randomNumber(5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Package::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'price' => $faker->randomFloat,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Summary::class, static function (Faker\Generator $faker) {
    return [
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Supplier::class, static function (Faker\Generator $faker) {
    return [
        'created_at' => $faker->dateTime,
        'name' => $faker->firstName,
        'phone' => $faker->sentence,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\DoctorMedicine::class, static function (Faker\Generator $faker) {
    return [
        'amount' => $faker->randomNumber(5),
        'cheminal_name' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'patient_history_id' => $faker->randomNumber(5),
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Brand::class, static function (Faker\Generator $faker) {
    return [
        'created_at' => $faker->dateTime,
        'name' => $faker->firstName,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Category::class, static function (Faker\Generator $faker) {
    return [
        'created_at' => $faker->dateTime,
        'name' => $faker->firstName,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\MedicinePricing::class, static function (Faker\Generator $faker) {
    return [
        'base_price' => $faker->randomFloat,
        'best_before_date' => $faker->date(),
        'created_at' => $faker->dateTime,
        'manufacture_date' => $faker->date(),
        'medicine_id' => $faker->randomNumber(5),
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\MedicinePricing::class, static function (Faker\Generator $faker) {
    return [
        'amount' => $faker->randomNumber(5),
        'base_price' => $faker->randomFloat,
        'best_before_date' => $faker->date(),
        'created_at' => $faker->dateTime,
        'manufacture_date' => $faker->date(),
        'medicine_id' => $faker->randomNumber(5),
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\ExamPackage::class, static function (Faker\Generator $faker) {
    return [
        'created_at' => $faker->dateTime,
        'employee_id' => $faker->randomNumber(5),
        'package_id' => $faker->randomNumber(5),
        'status' => $faker->sentence,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Exchange::class, static function (Faker\Generator $faker) {
    return [
        'created_at' => $faker->dateTime,
        'thb' => $faker->randomFloat,
        'updated_at' => $faker->dateTime,
        'usb' => $faker->randomFloat,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\NotificationReception::class, static function (Faker\Generator $faker) {
    return [
        'caller' => $faker->sentence,
        'class' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'patient' => $faker->sentence,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Wage::class, static function (Faker\Generator $faker) {
    return [
        'price' => $faker->randomFloat,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Exchange::class, static function (Faker\Generator $faker) {
    return [
        'created_at' => $faker->dateTime,
        'thb' => $faker->randomFloat,
        'updated_at' => $faker->dateTime,
        'usd' => $faker->randomFloat,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Province::class, static function (Faker\Generator $faker) {
    return [
        'created_at' => $faker->dateTime,
        'en_name' => $faker->sentence,
        'la_name' => $faker->sentence,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\District::class, static function (Faker\Generator $faker) {
    return [
        'created_at' => $faker->dateTime,
        'name' => $faker->firstName,
        'province_id' => $faker->randomNumber(5),
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\PatientStatistic::class, static function (Faker\Generator $faker) {
    return [
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\LabXrayEcho::class, static function (Faker\Generator $faker) {
    return [
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Profit::class, static function (Faker\Generator $faker) {
    return [
        
        
    ];
});
