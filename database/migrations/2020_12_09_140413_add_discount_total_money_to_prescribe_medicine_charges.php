<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountTotalMoneyToPrescribeMedicineCharges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prescribe_medicine_charges', function (Blueprint $table) {
            $table->integer('discount_total_money')->default(0)->after('doctor_fee_discount');
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
            $table->dropColumn(['discount_total_money']);
        });
    }
}
