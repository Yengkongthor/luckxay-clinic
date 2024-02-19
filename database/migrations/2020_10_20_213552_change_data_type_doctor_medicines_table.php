<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDataTypeDoctorMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctor_medicines', function (Blueprint $table) {
            $table->dropColumn(['time', 'tablet']);
            $table->text('times')->after('amount');
            $table->text('tablets')->after('times');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctor_medicines', function (Blueprint $table) {
            $table->string('time')->after('amount');
            $table->string('tablet')->after('times');
            $table->dropColumn(['times', 'tablets']);
        });
    }
}
