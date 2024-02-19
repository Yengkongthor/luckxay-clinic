<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDoctorFeeToPrescribeMedicineCharges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prescribe_medicine_charges', function (Blueprint $table) {
            $table->integer('doctor_fee')->after('discounted_services')->nullable();
            $table->integer('doctor_fee_discount')->after('doctor_fee')->nullable();
            $table->integer('medicine_discount')->after('doctor_fee_discount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prescribe_medicine_charges', function (Blueprint $table) {
            $table->dropColumn(['doctor_fee', 'doctor_fee_discount','medicine_discount']);
        });
    }
}
