<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovelExaminationLabDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('examination_lab_details');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('examination_lab_details', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_history_id');
            $table->integer('lab_detail_id');
            $table->timestamps();
        });
    }
}
