<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescribeMedicineChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescribe_medicine_charges', function (Blueprint $table) {
            $table->id();
            $table->integer('prescribe_medicine_id');
            $table->integer('charge');
            $table->integer('vat');
            $table->integer('exam_fee_discount');
            $table->integer('discounted_services');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescribe_medicine_charges');
    }
}
