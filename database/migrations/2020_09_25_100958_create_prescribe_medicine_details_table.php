<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescribeMedicineDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescribe_medicine_details', function (Blueprint $table) {
            $table->id();
            $table->integer('prescribe_medicine_id');
            $table->integer('medicine_id');
            $table->integer('amount');
            $table->double('cost');
            $table->double('price');
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
        Schema::dropIfExists('prescribe_medicine_details');
    }
}
